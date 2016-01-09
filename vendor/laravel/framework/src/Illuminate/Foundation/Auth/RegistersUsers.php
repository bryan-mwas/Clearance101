<?php

namespace Illuminate\Foundation\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;
use App\Models\Management;


trait RegistersUsers
{
    use RedirectsUsers;

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        return view('auth.register');
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postRegister(Request $request)
    {
        $validator = $this->validator($request->all());

        $post = $request->all();
        $value = $post['regNo'];

        $determiner = Student::where('studentNo',$value)->pluck('studentNo');
        $determiner1 = Management::where('id',$value)->pluck('id');

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        /*
         * Authorisation bit
         * This is to ensure a user does not input an invalid regNo
         * [i.e A value that does not exist in the students table or management table.
         * */
        elseif($determiner == null && $determiner1 == null){
            return 'The registration number ('.$value.') that you have entered does not exist in our database';
        }

        Auth::login($this->create($request->all()));

        return redirect($this->redirectPath());
    }

}
