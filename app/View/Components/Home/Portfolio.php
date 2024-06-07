<?php

namespace App\View\Components\Home;

use Closure;
use Illuminate\Support\Arr;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Portfolio extends Component
{
    public array $items = [];
    public array $tabs = [];

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = [
            [
                'category' => ['PHP'],
                'title' => 'SparkMVC - PHP MVC Framework',
                'image' => url('/img/spark-mvc.png'),
                'github' =>  'https://github.com/MoisesCorcho/SparkMVC'
            ],
            [
                'category' => ['PHP', 'Laravel', 'PHPUnit', 'Bootstrap'],
                'title' => 'Automobile Winner Landing Page & Admin Panel: Select Winner and Export Users',
                'image' => url('/img/github.png'),
                'github' =>  'https://github.com/MoisesCorcho/LandingPage-Challenge'
            ],
            [
                'category' => ['Laravel', 'JavaScript'],
                'title' => 'Interactive Appointment Calendar',
                'image' => url('/img/github.png'),
                'github' =>  'https://github.com/MoisesCorcho/Asimov-Challenge-jsonapi-Frontend'
            ],
            [
                'category' => ['PHP'],
                'title' => 'REST API for Scheduling Appointments - Plain PHP',
                'image' => url('/img/github.png'),
                'github' =>  'https://github.com/MoisesCorcho/DancingWithDeath-Challenge-LoginSystem'
            ],
            [
                'category' => ['Laravel', 'PHP', 'PHPUnit'],
                'title' => 'REST API for Scheduling Appointments Following The Json Api Specification - Laravel',
                'image' => url('/img/github.png'),
                'github' =>  'https://github.com/MoisesCorcho/Asimov-Challenge-jsonapi'
            ],
            [
                'category' => ['JavaScript', 'Tailwind CSS'],
                'title' => 'Typing Test',
                'image' => url('/img/github.png'),
                'github' =>  'https://github.com/MoisesCorcho/typingTest'
            ],
            [
                'category' => ['PHP', 'Laravel'],
                'title' => 'JsonApi-Package',
                'image' => url('/img/github.png'),
                'github' =>  'https://github.com/MoisesCorcho/JsonApi-Package'
            ],
            // [
            //     'category' => ['PHP'],
            //     'title' => '',
            //     'image' => url('/img/github.png'),
            //     'github' =>  ''
            // ],
        ];

        $this->tabs = array_unique(Arr::flatten(Arr::pluck($this->items, 'category')));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home.portfolio');
    }
}
