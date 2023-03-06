<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Portfolio;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function viewPortfolio()
    {
        $portfolioes=Portfolio::latest()->get();
        return view('admin.portfolio.view_portfolio', compact('portfolioes'));
    }

    public function addPortfolio(){
        return view('admin.portfolio.add_portfolio');
    }
}
