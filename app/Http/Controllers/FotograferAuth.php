<?php
namespace App\Http\Controllers;

use Validator;
use App\Fotografer;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Firebase\JWT\ExpiredException;
use Illuminate\Support\Facades\Hash;
use Laravel\Lumen\Routing\Controller as BaseController;

class FotograferAuth extends BaseController
{
    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    private $request;
    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    public function __construct(Request $request) {
        $this->request = $request;
    }
    /**
     * Create a new token.
     *
     * @param  \App\Fotografer   $user
     * @return string
     */
    protected function jwt(Fotografer $fotografer) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $fotografer->fotografer_id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60*60 // Expiration time
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }
    /**
     * Authenticate a user and return the token if the provided credentials are correct.
     *
     * @param  \App\Fotografer   $user
     * @return mixed
     */
    public function authenticate(Fotografer $fotografer) {
        $this->validate($this->request, [
            'username'     => 'required',
            'password'  => 'required'
        ]);
        // Find the user by username
        $fotografer = Fotografer::where('username', $this->request->input('username'))->first();
        if (!$fotografer) {
            // You wil probably have some sort of helpers or whatever
            // to make sure that you have the same response format for
            // differents kind of responses. But let's return the
            // below respose for now.
            return response()->json([
                'error' => 'Username does not exist.'
            ], 400);
        }
        // Verify the password and generate the token
        if (Hash::check($this->request->input('password'), $fotografer->password)) {
            return response()->json([
                'token'         => $this->jwt($fotografer),
                'fotografer_id' => $fotografer->fotografer_id,
                'name'          => $fotografer->name,
            ], 200);
        }
        // Bad Request response
        return response()->json([
            'error' => 'Username or password is wrong.'
        ], 400);
    }

    // public function register(Request $request)
    // {
    //     $validator = Validator::make($request->all(),[
    //         'name'     => 'required',
    //         'username' => 'required|min:5',
    //         'email'    => 'required|unique:users',
    //         'password' => 'required',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'success' => FALSE,
    //             'message' => $validator->errors(),
    //         ], 401);
    //     } else {
    //         $new_user = new \App\User;

    //         $new_user->name     = $request->input('name');
    //         $new_user->username = $request->input('username');
    //         $new_user->email    = $request->input('email');
    //         $new_user->password = password_hash($request->input('password'), PASSWORD_BCRYPT);

    //         if ($new_user->save()) {
    //             return response()->json([
    //                 'success' => TRUE,
    //                 'message' => 'Data berhasil di Post',
    //                 'data'    => $new_user,
    //             ], 201);
    //         } else {
    //             return response()->json([
    //                 'success' => FALSE,
    //                 'message' => 'Data gagal di Post',
    //                 'data'    => $new_user,
    //             ], 400);
    //         }
    //     }
    // }
}
