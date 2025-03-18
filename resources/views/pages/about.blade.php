@extends('components.layout.layout')

@section('title', 'Code & Lens - About Me')

@section('content')

<div class="flex flex-col items-center justify-center text-text-900 p-8" >
        <h1 class="text-xl p-4 font-two lg:text-4xl">{{__('About Me')}}</h1>
        <div class="max-w-5/6">
            <p class="font-one text-sm text-text-900 text-justify pb-4 lg:text-xl">{{__('My name is Claudio, and I am a passionate software developer, photographer, and filmmaker. I have over 24 years of experience as a teacher, dedicated to teaching and sharing knowledge in various creative and technological fields.')}}</p>
            <p class="font-one text-sm text-text-900 text-justify pb-4 lg:text-xl">{{__('As a FullStack developer, I am proficient in both FrontEnd and BackEnd development, working with technologies like HTML5, CSS3, JavaScript, SCSS, and frameworks such as ReactJS and Angular to create modern and engaging interfaces. On the BackEnd, I have experience with NodeJS, ExpressJS, PHP, Laravel, and Spring Boot. For mobile application development, I use technologies like Flutter and Kotlin, and I also manage SQL and NoSQL databases such as MySQL and MongoDB.')}}</p>
            <p class="font-one text-sm text-text-900 text-justify pb-4 lg:text-xl">{{__('In the visual field, as a photographer and filmmaker, I combine creativity and technique to capture and tell unique stories, reflecting my passion for solving complex challenges with innovative solutions.')}}</p>
            <p class="font-one text-sm text-text-900 text-justify pb-4 lg:text-xl">{{__('My goal is clear: to share everything I have learned throughout my career and help others develop their skills in programming, photography, and video. I am here to guide you on this exciting journey of learning and creation!')}}</p>
        </div>
    </div>

@endsection