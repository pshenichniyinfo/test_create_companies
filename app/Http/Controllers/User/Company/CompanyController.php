<?php

namespace App\Http\Controllers\User\Company;

use App\Http\Controllers\ApiController;
use App\Http\Requests\User\CreateCompanyRequest;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends ApiController
{
    public function companies(Request $request, User $user)
    {
        $companies = $user::where('id', Auth::id())->with('companies')->first();

        return $this->sendResponse($companies, 'Success response');
    }

    public function add_company(CreateCompanyRequest $createCompanyRequest)
    {
        $company = new Company();

        $company->title = $createCompanyRequest->title;
        $company->phone = $createCompanyRequest->phone;
        $company->description = $createCompanyRequest->description;
        $company->save();

        $company->users()->attach(Auth::id());

        return $this->sendResponse(['company' => $company], 'Successful added company');
    }
}
