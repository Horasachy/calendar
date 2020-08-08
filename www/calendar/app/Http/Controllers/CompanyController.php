<?php

namespace App\Http\Controllers;

use App\Http\Requests\Company\StoreRequest;
use App\Http\Requests\Company\UpdateRequest;
use App\Models\Company;
use App\Models\CompanyUser;
use App\Models\User;

/**
 * Class CompanyController
 * @package App\Http\Controllers
 */
class CompanyController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('company.index', ['companies' => Company::get()]);
    }

    /**
     * @param null $company
     * @param null $checked_employees
     * @return array
     */
    public function returnData($company = null, $checked_employees = null)
    {
        if(!is_null($company)){
            $checked_employees = $company->users()->get()->pluck('id')->toArray();
        }
        $users = User::get();

        return compact('checked_employees', 'users', 'company');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('company.create', $this->returnData());
    }

    /**
     * @param Company $company
     * @param StoreRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Company $company, StoreRequest $request)
    {
        $company->fill($request->all());
        $company->save();
        $this->createUserCustomers($request->all());
        return redirect()->route('company.index');
    }

    /**
     * @param Company $company
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Company $company)
    {
        return view('company.edit', $this->returnData($company));
    }

    /**
     * @param Company $company
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete(Company $company)
    {
        $company->delete();
        return redirect()->route('company.index');
    }

    /**
     * @param $inputs
     */
    public function createUserCustomers($inputs)
    {
        foreach ($inputs['employee_id'] as $employee) {
            CompanyUser::create([
                'employee_id' => $employee,
                'company_id' => Company::latest()->first()->id
            ]);
        }
    }

    /**
     * @param Company $company
     * @param UpdateRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Company $company, UpdateRequest $request)
    {
        $company->fill($request->all());
        $company->save();

        $this->deleteCompanyUsers($request);
        if(!empty($request['employee_id'])) {
            $this->createUserCustomers($request);
        }

        return redirect(route('company.index'));
    }

    /**
     * @param $inputs
     */
    public function deleteCompanyUsers($inputs)
    {
        CompanyUser::where('company_id', $inputs['company_id'])->delete();
    }
}
