<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\User;
use App\Models\Software;



class CoursesController extends Controller
{

    public function index()
    {
        $courses = Course::with('user')
            ->orderBy('category', 'asc')
            ->paginate(10);
        return view('pages.courses.courses', compact('courses'));
    }


    public function create()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'instructor']);
        })->get();
    
        return view('pages.courses.create', compact('users'));
    }


    public function store(Request $request)
    {
        $validated = $this->validateCourse($request);

        $course = new Course();
        $course->name = $validated['name'];
        $course->description = $validated['description'];
        $course->price = $validated['price'];
        $course->days1 = $validated['days1'] ?? null;
        $course->days2 = $validated['days2'] ?? null;
        $course->duration = $validated['duration'] ?? null;
        $course->category = $validated['category'] ?? null;
        $course->capacity = $validated['capacity'] ?? null;
        $course->user_id = $validated['user_id'];
        $course->active = $request->has('active');

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('courses', $imageName, 'public');
            $course->image = $imageName;
        }

        $course->save();

        return redirect()->route('courses.index')->with('success', __('Course created successfully'));
    }

    
    public function show($id)
    {
        $course = Course::findOrFail($id);
        return view('pages.courses.course', compact('course', 'id'));
    }

    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'instructor']);
        })->get();

        return view('pages.courses.edit', compact('course', 'users', 'id'));
    }

    public function update(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $validated = $this->validateCourse($request);

        $course->name = $validated['name'];
        $course->description = $validated['description'];
        $course->price = $validated['price'];
        $course->days1 = $validated['days1'] ?? null;
        $course->days2 = $validated['days2'] ?? null;
        $course->duration = $validated['duration'] ?? null;
        $course->category = $validated['category'] ?? null;
        $course->capacity = $validated['capacity'] ?? null;
        $course->user_id = $validated['user_id'];
        $course->active = $request->has('active');

        if ($request->hasFile('image')) {
            if ($course->image && Storage::disk('public')->exists('courses/' . $course->image)) {
                Storage::disk('public')->delete('courses/' . $course->image);
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('courses', $imageName, 'public');
            $course->image = $imageName;
        }

        $course->save();

        return redirect()->route('courses.show', $id)->with('success', __('Course updated successfully'));
    }

    private function validateCourse(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'days1' => 'nullable|string|max:255',
            'days2' => 'nullable|string|max:255',
            'duration' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'capacity' => 'nullable|integer|min:0',
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image|max:4096',
        ], [
            'name.required' => 'El nombre es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'price.required' => 'El precio es obligatorio.',
            'price.numeric' => 'El precio debe ser un número.',
            'user_id.required' => 'Seleccioná un instructor.',
            'user_id.exists' => 'El instructor seleccionado no es válido.',
            'image.image' => 'El archivo debe ser una imagen.',
        ]);
    }

    public function destroy($id)
    {
        $course = Course::findOrFail($id);

        if ($course->image && Storage::disk('public')->exists('courses/' . $course->image)) {
            Storage::disk('public')->delete('courses/' . $course->image);
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', __('Course deleted successfully'));
    }

    public function cursos()
    {
        $courses = Course::with('user')
            ->where('active', true)
            ->orderBy('category', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        $coursesByCategory = $courses->groupBy('category');

        return view('pages.cursos', compact('coursesByCategory'));
    }

    public function cursoDetail($id)
    {
        $course = Course::findOrFail($id);
        return view('pages.courses.courseDetail', compact('course', 'id'));
    }

    public function enroll(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'course_id' => 'required',
            'enroll_day' => 'nullable',
        ]);

        $user = User::findOrFail($request->user_id);
        
        $course = Course::findOrFail($request->course_id);

        $enroll_day = $request->enroll_day;

        $columnName = 'enroll_day_'.$enroll_day;

        $isEnrolled = $user->courses()->where('course_id', $request->course_id)->exists();

        if ($isEnrolled) {
            return redirect()->back()->with('error', 'Ud. ya está inscrito en este curso');
        }

        if(empty($course->days2)){

            $user->courses()->attach($request->course_id);   
            
            return redirect()->route('dashboard');

        } else{
            if($course->{$columnName}== 0){
                return redirect()->back()->with('error', 'No hay cupos disponibles para este dia');
            }
            $user->courses()->attach($request->course_id, ['enroll_day' => $request->enroll_day]);
            $course->decrement($columnName, 1);
            return redirect()->route('dashboard');
        }
        
        
        
    }

    public function cursosDashboard()
    {
        $courses = Course::with('user')
            ->where('active', true)
            ->orderBy('category', 'asc')
            ->orderBy('name', 'asc')
            ->get();

        $coursesByCategory = $courses->groupBy('category');

        $enrolledCourseIds = Auth::user()->courses->pluck('id');

        return view('pages.dashboard.cursos', compact('coursesByCategory', 'enrolledCourseIds'));
    }

    public function showStudents($courseId)
    {
        $course = Course::findOrFail($courseId);
        $students = $course->students()
            ->withPivot('status')
            ->orderBy('lastname', 'asc')
            ->paginate(15); 

        return view('pages.courses.students', compact('course', 'students'));
    }

    public function updateStatus(Request $request, $courseId, $userId)
    {
        $course = Course::findOrFail($courseId);
        $user = User::findOrFail($userId);

        $course->students()->updateExistingPivot($user->id, [
            'status' => $request->status
        ]);

        return redirect()->route('cursos.students', $courseId)->with('success', 'Status updated successfully!');
    }

    public function removeStudent($courseId, $userId)
    {
        $course = Course::findOrFail($courseId);
        $user = User::findOrFail($userId);

        $enrollment = $course->students()->where('user_id', $userId)->first();

        if (!$enrollment) {
            return redirect()->route('cursos.students', $courseId)
                ->with('error', __('This student is not enrolled in this course.'));
        }

        
        $enrollDay = $enrollment->pivot->enroll_day;
        if (!empty($course->days2) && !empty($enrollDay)) {
            $course->increment('enroll_day_' . $enrollDay, 1);
        }

        
        $classIds = $course->classes()->pluck('id');
        Attendance::where('user_id', $userId)
            ->whereIn('class_id', $classIds)
            ->delete();

        $course->students()->detach($userId);

        return redirect()->route('cursos.students', $courseId)
            ->with('success', __('Student removed from the course successfully'));
    }

    public function showClasses($courseId)
    {
        $course = Course::findOrFail($courseId);  
        $classes = $course->classes()
            ->orderBy('date', 'desc')
            ->paginate(10);

        return view('pages.courses.classesCourse', compact('course', 'classes'));
    }

    public function showClassesStudents($courseId)
    {
        $course = Course::findOrFail($courseId);

        $classes = Classes::where('course_id', $courseId)
            ->orderByDesc('date')
            ->orderBy('start_time')
            ->paginate(14);

        return view('pages.courses.classes', compact('course', 'classes'));
    }

    public function home()
    {
        $courses = Course::where('active', true)->inRandomOrder()->take(6)->get();

        $softwares = Software::where('active', true)
            ->orderBy('featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();

        return view('pages.home', compact('courses', 'softwares'));
    }
    
}