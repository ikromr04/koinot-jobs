<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Vacancy;
use App\Models\VacancyTranslation;
use Illuminate\Contracts\View\View as ViewView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PageController extends Controller
{
    public function index(): View
    {
        $hotVacancies = Vacancy::with([
            'company.translation',
            'translation' => function ($query) {
                $query->select([
                    'id',
                    'vacancy_id',
                    'locale',
                    'title',
                    'city',
                    DB::raw('SUBSTRING( REGEXP_REPLACE(content, \'<[^>]*>\', \'\'), 1, 88 ) as description'),
                ]);
            }
        ])
            ->whereHas('translation')
            ->where('hot', true)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::with('translation')
            ->whereHas('translation')
            ->get();

        return view('pages.index', compact('hotVacancies', 'categories'));
    }

    public function team(): View
    {
        return view('pages.team');
    }

    public function resume(): View
    {
        return view('pages.resume');
    }

    public function vacancies(Request $request): View
    {
        $vacancies = Vacancy::with([
            'company.translation',
            'category.translation',
            'translation' => function ($query) {
                $query->select([
                    'id',
                    'vacancy_id',
                    'locale',
                    'title',
                    'city',
                    DB::raw('SUBSTRING( REGEXP_REPLACE(content, \'<[^>]*>\', \'\'), 1, 88 ) as description'),
                ]);
            }
        ]);

        if ($request->query('city')) {
            $vacancies = $vacancies->whereHas('translation', function ($query) use ($request) {
                $query->where('city', $request->query('city'));
            });
        }

        if ($request->query('company')) {
            $vacancies = $vacancies->where('company_id', $request->query('company'));
        }

        if ($request->query('category')) {
            $vacancies = $vacancies->where('category_id', $request->query('category'));
        }

        $vacancies = $vacancies->whereHas('translation')
            ->paginate(5)
            ->appends(request()->query());

        $cities = VacancyTranslation::pluck('city')->unique()->values();

        $categories = Category::with('translation')
            ->whereHas('translation')
            ->get();

        $companies = Company::with('translation')
            ->whereHas('translation')
            ->get();

        return view('pages.vacancies.index', compact('vacancies', 'cities', 'categories', 'companies'));
    }

    public function vacancy(Vacancy $vacancy): ViewView
    {
        $data = (object)[
            'vacancy' => $vacancy,
            'similarVacancies' => Vacancy::select([
                'id',
                'lang',
                'company_id',
                'category_id',
                'city',
                'title',
                DB::raw('SUBSTRING(content, 1, 88) as description')
            ])->where('category_id', $vacancy->category->id)->get(),
        ];

        return view('pages.vacancies.show', compact('data'));
    }

    public function category(Category $category): View
    {
        $data = (object)[
            'vacancies' => Vacancy::select([
                'id',
                'lang',
                'company_id',
                'category_id',
                'city',
                'title',
                DB::raw('SUBSTRING(content, 1, 88) as description')
            ])
                ->where('category_id', $category->id)
                ->latest()
                ->get(),
            'category' => $category,
        ];

        return view('pages.categories.show', compact('data'));
    }

    public function teambuilding(): View
    {
        return view('pages.teambuilding');
    }

    public function faq(): View
    {
        return view('pages.faq');
    }
}
