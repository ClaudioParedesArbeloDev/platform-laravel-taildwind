<?php

namespace App\Http\Controllers;

use App\Models\Software;
use App\Models\SoftwareAddon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SoftwareController extends Controller
{
    
    public function index()
    {
        $softwares = Software::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.software.softwares', compact('softwares'));
    }

    
    public function catalog()
    {
        $softwares = Software::where('active', true)
            ->orderBy('featured', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $softwaresByCategory = $softwares->groupBy(function ($software) {
            return $software->category ?: 'General';
        });

        return view('pages.softwareCatalog', compact('softwares', 'softwaresByCategory'));
    }

    public function create()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'instructor']);
        })->get();

        return view('pages.software.create', compact('users'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateSoftware($request);

        $software = new Software();
        $this->fillSoftware($software, $validated, $request);
        $software->save();

        return redirect()->route('software.index')->with('success', __('Software created successfully'));
    }

    public function show($id)
    {
        $software = Software::with(['activeAddons'])->findOrFail($id);
        return view('pages.software.show', compact('software', 'id'));
    }

    public function edit($id)
    {
        $software = Software::with('addons')->findOrFail($id);
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['admin', 'instructor']);
        })->get();

        return view('pages.software.edit', compact('software', 'users', 'id'));
    }

    public function update(Request $request, $id)
    {
        $software = Software::findOrFail($id);
        $validated = $this->validateSoftware($request);

        $this->fillSoftware($software, $validated, $request);
        $software->save();

        return redirect()->route('software.show', $id)->with('success', __('Software updated successfully'));
    }

    public function destroy($id)
    {
        $software = Software::findOrFail($id);
        $software->delete();

        return redirect()->route('software.index')->with('success', __('Software deleted successfully'));
    }

    private function validateSoftware(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|string|max:100|unique:softwares,sku,' . $request->route('id'),
            'description' => 'required|string',
            'short_description' => 'nullable|string|max:255',
            'type' => 'required|in:generico,medida',
            'platform' => 'nullable|string|max:100',
            'license_type' => 'nullable|in:unica,anual',
            'price' => 'nullable|numeric|min:0',
            'requires_quote' => 'nullable|boolean',
            'category' => 'nullable|string|max:255',
            'demo_url' => 'nullable|url',
            'manual_url' => 'nullable|url',
            'download_url' => 'nullable|url',
            'purchase_url' => 'nullable|url',
            'user_id' => 'required|exists:users,id',
            'image' => 'nullable|image',
        ]);
    }

    private function fillSoftware(Software $software, array $validated, Request $request): void
    {
        $software->name = $validated['name'];
        $software->sku = $validated['sku'] ?? null;
        $software->short_description = $validated['short_description'] ?? null;
        $software->description = $validated['description'];
        $software->type = $validated['type'];
        $software->platform = $validated['platform'] ?? null;
        $software->license_type = $validated['license_type'] ?? null;
        $software->price = $validated['price'] ?? null;
        $software->requires_quote = $request->has('requires_quote');
        $software->category = $validated['category'] ?? null;
        $software->demo_url = $validated['demo_url'] ?? null;
        $software->manual_url = $validated['manual_url'] ?? null;
        $software->download_url = $validated['download_url'] ?? null;
        $software->purchase_url = $validated['purchase_url'] ?? null;
        $software->featured = $request->has('featured');
        $software->active = $request->has('active');
        $software->user_id = $validated['user_id'];

        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->storeAs('software', $imageName, 'public');
            $software->image = $imageName;
        }
    }

   
    public function storeAddon(Request $request, $softwareId)
    {
        $software = Software::findOrFail($softwareId);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);

        $software->addons()->create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'active' => true,
        ]);

        return redirect()->route('software.edit', $softwareId)->with('success', __('Addon created successfully'));
    }

    public function destroyAddon($softwareId, $addonId)
    {
        $addon = SoftwareAddon::where('software_id', $softwareId)->findOrFail($addonId);
        $addon->delete();

        return redirect()->route('software.edit', $softwareId)->with('success', __('Addon deleted successfully'));
    }

    
    public function myPurchases()
    {
        $user = Auth::user();

        $purchases = $user->software()
            ->orderByPivot('created_at', 'desc')
            ->get();

        return view('pages.software.myPurchases', compact('purchases'));
    }
}