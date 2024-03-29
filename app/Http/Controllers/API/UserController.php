<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Enums\UserTypes;
use App\Mail\ForgotPasswordMail;
use App\Helpers\Media;
use App\Mail\CareTakerRegisteredMail;
use App\Mail\RegisterUserMail;
use App\Models\ChatRoom;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    private function genegerateOTP()
    {
        return rand(1000, 9999);
    }

    private function userAuthResponse($user, $params = [])
    {
        $token = $user->createToken('api-authentication')->accessToken;

        return [
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => array_merge($user->getUserDisplayFields(), $params)
        ];
    }

    private function handleUserFcmToken($user, $fcm_token)
    {
        $user->fcm_token = $fcm_token;
        $user->save();
    }
    public function register(Request $request)
    {
        try {
            $otp = rand(1000, 9999);
            
            $userType = $request->input('user_type');
            if ($userType === 'patient') {
                $validator = Validator::make($request->all(), [
                    'full_name' => 'required|string|max:120',
                    'email' => 'required|email|unique:users|max:30',
                    'height' => 'required|numeric',
                    'weight' => 'required|numeric',
                    'relation_to_patient' => 'required|string',
                    'gender' => 'required|in:male,female',
                    'dob' => 'required',
                    'contact_number' => 'required|string|max:15',
                    'medical_condition' => 'required|string',
                    'major_disease' => 'required|string',
                    'full_address' => 'required|string',
                    'password' => 'required|string|min:6|max:20|confirmed',
                    'user_type' => 'required|in:patient',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => 422,
                        'success' => false,
                        'message' => 'Validation failed',
                        'errors' => $validator->errors(),
                    ], 422);
                }
                $otp = rand(1000, 9999);
                $patient = new User();
                $patient->full_name = $request->input('full_name');
                $patient->email = $request->input('email');
                $patient->contact_number = $request->input('contact_number');
                $patient->dob = $request->input('dob');
                $patient->full_address = $request->input('full_address');
                $patient->password = Hash::make($request->input('password'));
                $patient->dob = $request->input('dob');
                $patient->height = $request->input('height');
                $patient->weight = $request->input('weight');
                $patient->gender = $request->input('gender');
                $patient->status = 0;
                $patient->medical_condition = $request->input('medical_condition');
                $patient->major_disease = $request->input('major_disease');
                $patient->role_id = 1;
                $patient->user_type = 'patient';
                $patient->otp = $otp;
                $patient->save();
                $body = [
                    'name' => $patient->full_name,
                    'email' => $patient->email,
                    'otp' => $otp
                ];
    
                Mail::to($patient->email)->send(new RegisterUserMail($body));
         

            } elseif ($userType === 'caretaker') {
                $validator = Validator::make($request->all(), [
                    'full_name' => 'required|string|max:120',
                    'email' => 'required|email|unique:users|max:30',
                    'password' => 'required|string|min:6|confirmed',
                    'contact_number' => 'required|string|max:15',
                    'dob' => 'required|date|before:-18 years',
                    'full_address' => 'required|string',
                    'relationship_status' => 'required|string',
                    'gender' => 'required|in:male,female',
                ]);

                if ($validator->fails()) {
                    return response()->json([
                        'status' => 422,
                        'success' => false,
                        'message' => 'Validation failed',
                        'errors' => $validator->errors(),
                    ], 422);
                }

                $caretaker = new User();
                $caretaker->full_name = $request->input('full_name');
                $caretaker->email = $request->input('email');
                $caretaker->contact_number = $request->input('contact_number');
                $caretaker->dob = $request->input('dob');
                $caretaker->full_address = $request->input('full_address');
                $caretaker->gender = $request->input('gender');
                $caretaker->relationship_status = $request->input('relationship_status');
                $caretaker->status = 0;
                $caretaker->password = Hash::make($request->input('password'));
                $caretaker->role_id = 2; // Set caretaker role_id
                $caretaker->user_type = 'caretaker';
                $caretaker->otp = $otp;
                $caretaker->save();
                $body = [
                    'name' => $caretaker->full_name,
                    'email' => $caretaker->email,
                    'otp' => $otp
                ];
    
                Mail::to($caretaker->email)->send(new CareTakerRegisteredMail($body));
            } else {
                return response()->json([
                    'status' => 422,
                    'success' => false,
                    'message' => 'Invalid user_type',
                ], 422);
            }

            $response = [
                'status' => 201,
                'success' => true,
                'message' => ucfirst($userType) . ' registered successfully',
                'user_type' => $userType,
                'data' => ($userType === 'patient') ? $patient : [$caretaker],
            ];

            return response()->json($response, 201);
        } catch (\Exception $e) {
            $response = [
                'status' => 500,
                'success' => false,
                'message' => 'An error occurred during registration',
                'error' => $e->getMessage(),
            ];
            return response()->json($response, 500);
        }
    }

    public function login(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'required'
            ]);

            if ($validator->fails()) {
                throw new \ErrorException($validator->errors()->first());
            }

            if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                throw new \ErrorException('Invalid Credentials');
            }

            $user = Auth::user();

            if ($user->status == 0) {
                throw new \ErrorException('Please verify your account');
            }

            if (isset($request->fcm_token)) {
                $this->handleUserFcmToken($user, $request->fcm_token);
            }

            $response = [
                'status' => 200,
                'message' => 'Successfully logged in',
                'data' => $this->userAuthResponse($user)
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function forgotPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required'
            ]);

            if ($validator->fails()) {
                throw new \ErrorException($validator->errors()->first());
            }

            $user = User::where('email', $request->email)->first();
            $otp = $this->genegerateOTP();

            if ($user == null) {
                throw new \ErrorException('User with this email does not exists');
            }

            $user->update(['otp' => $otp]);

            // Send Email
            $body = [
                'name' => $user->first_name . " " . $user->last_name,
                'email' => $user->email,
                'otp' => $otp
            ];

            Mail::to($user->email)->send(new ForgotPasswordMail($body));

            $response = [
                'status' => 200,
                'message' => 'Forgot password request has been sent! Please check your mail for OTP verification'
            ];
            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function resetPassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'otp' => 'required|min:4|max:4',
                'email' => 'required|email',
                'password' => 'required|confirmed|min:6',
            ]);

            if ($validator->fails()) {
                throw new \ErrorException($validator->errors()->first());
            }

            $user = User::where('email', $request->email)->where('otp', $request->otp)->first();

            if ($user == null) {
                throw new \ErrorException('Invalid Email or OTP');
            }

            $user->update([
                'password' => bcrypt($request->password),
                'otp' => $this->genegerateOTP()
            ]);

            $response = [
                'status' => 200,
                'message' => 'Your password has been reset!'
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function socialAuthentication(Request $request)
    {
        try {
            $validation = [
                'first_name' => 'required|max:255',
                'last_name' => 'required|max:255',
                'email' => 'required|email',
                'social_type' => 'required',
                'social_id' => 'required',
            ];

            if ($request->social_type == "apple") {
                unset($validation['first_name']);
                unset($validation['last_name']);
                unset($validation['email']);
            }

            $validator = Validator::make($request->all(), $validation);

            if ($validator->fails()) {
                throw new \ErrorException($validator->errors()->first());
            }

            if ($request->social_type == "apple") {

                $tokenParts = explode(".", $request->social_id);
                $tokenPayload = base64_decode($tokenParts[1]);
                $jwtPayload = json_decode($tokenPayload);

                if (isset($jwtPayload->username)) {
                    $email = $jwtPayload->username;
                }

                if (isset($jwtPayload->email)) {
                    $email = $jwtPayload->email;
                }

                $first_name = explode("@", $email)[0];
                $last_name = explode("@", $email)[0];
            } else {
                $first_name = $request->first_name;
                $last_name = $request->last_name;
                $email = $request->email;
            }

            $new_account = false;
            $user = User::where('email', $email)->first();

            if ($user == null) {
                $user = new User();
                $user->first_name = $first_name;
                $user->last_name = $last_name;
                $user->email = $email;
                $user->password = bcrypt('admin123');
                $user->otp = $this->genegerateOTP();
                $user->status = 1; // Account is active by default
                $user->role_id = UserTypes::User; // Account is type User
                $user->save();

                $new_account = true;
            }

            if (isset($request->fcm_token)) {
                $this->handleUserFcmToken($user, $request->fcm_token);
            }

            User::where('id', $user->id)->update([
                'social_type' => $request->social_type,
                'social_id' => $request->social_id,
                'first_name' => $first_name,
                'last_name' => $last_name,
            ]);

            $response = [
                'status' => 200,
                'message' => 'Successfully logged in',
                'data' => $this->userAuthResponse($user, [
                    'new_account' => $new_account
                ])
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function logout(Request $request)
    {
        try {
            // Revoke Token
            $res = $request->user()->token()->revoke();

            if ($res == null) {
                throw new \ErrorException('Something went wrong');
            }

            $response = [
                'status' => 200,
                'message' => "Successfully logged out"
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function editProfile(Request $request)
    {
        try {
            $user = $request->user();

            if ($request->has('first_name')) {
                $user->first_name = $request->first_name;
                $user->save();
            }

            if ($request->has('last_name')) {
                $user->last_name = $request->last_name;
                $user->save();
            }

            if ($request->has('contact_number')) {
                $user->contact_number = $request->contact_number;
                $user->save();
            }

            if ($request->has('old_password') || $request->has('password')) {
                $validator = Validator::make($request->all(), [
                    'old_password' => 'required|min:6',
                    'password' => 'required|confirmed|min:6',
                ]);

                if ($validator->fails()) {
                    throw new \ErrorException($validator->errors()->first());
                }

                if (!Hash::check($request->old_password, $user->password)) {
                    throw new \ErrorException('Old password does not match');
                }

                $user->password = bcrypt($request->password);
                $user->save();
            }

            if ($request->has('country_id')) {
                $user->country_id = $request->country_id;
                $user->save();
            }

            if ($request->has('state_id')) {
                $user->state_id = $request->state_id;
                $user->save();
            }

            if ($request->has('city_id')) {
                $user->city_id = $request->city_id;
                $user->save();
            }

            if ($request->has('zip_code')) {
                $user->zip_code = $request->zip_code;
                $user->save();
            }

            $response = [
                'status' => 200,
                'message' => "Details updated",
                'data' => [
                    'user' => $user->getUserDisplayFields()
                ]
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function uploadPicture(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'picture' => 'required|mimes:jpg,jpeg,png',
            ]);

            if ($validator->fails()) {
                throw new \ErrorException($validator->errors()->first());
            }

            $user = $request->user();
            $updatedUrl = $user->profile_picture;

            if ($request->has('picture')) {
                $updatedUrl = Media::profileAvatar($request->picture);
                $user->profile_picture = $updatedUrl;
                $user->save();
            }

            $response = [
                'status' => 200,
                'message' => "",
                'data' => [
                    'profile_picture' => Media::convertFullUrl($updatedUrl)
                ]
            ];

            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function createChatRoom(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|numeric'
            ]);

            if ($validator->fails()) {
                throw new \ErrorException($validator->errors()->first());
            }

            $already_exists = false;

            $chatRoom = ChatRoom::where('author_id', $request->user()->id)->where('participant_id', $request->user_id)->first();

            if ($chatRoom == null) {
                $chatRoom = ChatRoom::where('author_id', $request->user_id)->where('participant_id', $request->user()->id)->first();
            }

            if ($chatRoom != null) {
                $already_exists = true;
            }

            if ($chatRoom == null) {
                $chatRoom = new ChatRoom();
                $chatRoom->author_id = $request->user()->id;
                $chatRoom->participant_id = $request->user_id;
                $chatRoom->status = 1;
                $chatRoom->save();
            }

            $response = [
                'status' => 200,
                'message' => "",
                'data' => [
                    "already_exists" => $already_exists,
                    "room" => $chatRoom
                ]
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function getAllChatsRooms(Request $request)
    {
        try {
            $rooms = ChatRoom::where(function ($query) use ($request) {
                $query->where('author_id', $request->user()->id)
                    ->orWhere('participant_id', $request->user()->id);
            })->orderby('updated_at', 'DESC')->get();

            $arr = [];

            foreach ($rooms as $room) {

                $author = $room->Author ? $room->Author->getUserDisplayFields() : null;
                $participant = $room->Participant ? $room->Participant->getUserDisplayFields() : null;

                array_push($arr, [
                    "id" => $room->id,
                    "status" => $room->status,
                    "created_at" => $room->created_at,
                    "updated_at" => $room->updated_at,
                    "user" => $room->author_id == $request->user()->id ? $participant : $author
                ]);
            }

            $response = [
                'status' => 200,
                'message' => "",
                'data' => [
                    "rooms" => $arr
                ]
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }

    public function getProfileDetails(Request $request)
    {
        try {
            $user = User::where('id', $request->user()->id)->with(['payments' => function ($e) {
                $e->select(['id', 'amount', 'user_id', "plan_id"])
                    ->with('plan')
                    ->select(['id', 'amount', 'user_id', "plan_id"]);
            }])->first();

            $response = [
                'status' => 200,
                'message' => "",
                'data' => [
                    'user' => array_merge($user->getUserDisplayFields(), [
                        'payments' => $user->payments
                    ])
                ]
            ];

            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 422,
                'message' => $e->getMessage(),
            ], 422);
        }
    }
}
