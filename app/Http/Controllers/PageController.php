<?php

namespace App\Http\Controllers;

use App\Models\Block;
use App\Models\Category;
use App\Models\Company;
use App\Models\Faq;
use App\Models\News;
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
        $faqs = Faq::with(['translation'])
            ->whereHas('translation')
            ->get();

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
            ->where('hidden', false)
            ->latest()
            ->take(8)
            ->get();

        $categories = Category::with('translation')
            ->whereHas('translation')
            ->get();

        $numbers = Block::where('slug', 'numbers')
            ->with('translation')
            ->first();

        $blog = Block::where('slug', 'news')
            ->with('translation')
            ->first();

        $news = News::with([
            'translation' => function ($query) {
                $query->select([
                    'id',
                    'news_id',
                    'locale',
                    'image',
                    'title',
                    'content',
                    DB::raw('SUBSTRING( REGEXP_REPLACE(content, \'<[^>]*>\', \'\'), 1, 118 ) as description'),
                ]);
            }
        ])
            ->whereHas('translation')
            ->orderBy('date', 'desc')
            ->take(3)
            ->get();

        return view('pages.index', compact('hotVacancies', 'categories', 'numbers', 'blog', 'news', 'faqs'));
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
        ])
            ->where('hidden', false)
            ->latest();

        if ($request->query('city')) {
            $vacancies = $vacancies->whereHas('translation', function ($query) use ($request) {
                $query->where('city', $request->query('city'));
            });
        }

        $vacancies = $vacancies->when(
            $request->query('company'),
            fn($query, $companies) =>
            $query->whereIn('company_id', explode(',', $companies))
        );

        $vacancies = $vacancies->when(
            $request->query('category'),
            fn($query, $categories) =>
            $query->whereIn(
                'category_id',
                explode(',', $categories)
            )
        );

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
        ])
            ->latest()
            ->where('category_id', $vacancy->category?->id)
            ->where('hidden', false)
            ->get();

        return view('pages.vacancies.show', compact('vacancy', 'vacancies'));
    }

    public function category(Category $category): View
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
        ])
            ->where('category_id', $category->id)
            ->where('hidden', false)
            ->latest()
            ->get();

        return view('pages.categories.show', compact('category', 'vacancies'));
    }

    public function teambuilding(): View
    {
        return view('pages.teambuilding');
    }

    public function faq(): View
    {
        $faqs = Faq::with(['translation'])
            ->whereHas('translation')
            ->get();

        return view('pages.faq', compact('faqs'));
    }

    public function news(): View
    {
        $blog = Block::where('slug', 'news')
            ->with('translation')
            ->first();

        $news = News::with([
            'translation' => function ($query) {
                $query->select([
                    'id',
                    'news_id',
                    'locale',
                    'image',
                    'title',
                    'content',
                    DB::raw('SUBSTRING( REGEXP_REPLACE(content, \'<[^>]*>\', \'\'), 1, 118 ) as description'),
                ]);
            }
        ])
            ->whereHas('translation')
            ->orderBy('date', 'desc');

        if (request()->query('sort') === 'desc') {
            $news = $news->oldest();
        } else {
            $news = $news->latest();
        }

        $news = $news->get();

        return view('pages.news.index', compact('blog', 'news'));
    }

    public function newsShow(string $id): View
    {
        $news = News::with('translation')
            ->findOrFail($id);

        return view('pages.news.show', compact('news'));
    }
}
