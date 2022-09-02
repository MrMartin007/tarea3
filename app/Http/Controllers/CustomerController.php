<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use App\Customer;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {


        $customers = Customer::orderBy('id')->paginate(5);

        return [
            'pagination' => [
                'total'         => $customers->total(),
                'current_page'  => $customers->currentPage(),
                'per_page'      => $customers->perPage(),
                'last_page'     => $customers->lastPage(),
                'from'          => $customers->firstItem(),
                'to'            => $customers->lastPage(),
            ],
            'customers' => $customers
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'addres' => 'required',
            'phone_number' => 'required'
        ]);

        Customer::create($request->all());

        return;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'addres' => 'required',
            'phone_number' => 'required',
        ]);

        Customer::find($id)->update($request->all());

        return;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
    }
}
