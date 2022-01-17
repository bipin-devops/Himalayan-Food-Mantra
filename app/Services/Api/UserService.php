<?php


namespace App\Services\Api;


use App\ApiUser;
use App\ApiUserToken;
use App\Exceptions\Api\ItemNotFoundException;
use App\Services\CommonService;
use App\Services\ConstantStatusService;
use App\User;
use Carbon\Carbon;
use EkHelper;
use Illuminate\Support\Facades\Hash;
use Input;
class UserService
{
    private $user;
    /**
     * @var ApiUser
     */
    private $apiUser;

    /**
     * ArticleService constructor.
     */
    public function __construct()
    {
        $this->user = new User();
        $this->apiUser = new ApiUser();
        $this->commonService = new CommonService();
    }

    /**
     * @return mixed
     *
     */
    function getAllArticles()
    {
        return $this->user->paginate(50);

    }

    /**
     * @param $id
     * @return mixed
     */
    function findById($id)
    {
        return $this->user->find($id);
    }

    /**
     * @param $data
     * @return static
     */
    function store($data)
    {



        $data['password'] = bcrypt($data['password']);
        $apiuser = ApiUser::create($data);


        return $apiuser;

    }

    /**
     * @param $email
     * @param $data
     * @return mixed
     */
    function checkEmail($email)
    {

        $user = $this->apiUser->where('email', $email)->first();

        if (is_null($user)) {
            return false;
        } else

            return $user;
    }

    /**
     *
     */
    function itemNotFound()
    {
        $error['error'] = "not-found";
        $error['message'] = "Item not found";
    }

    /**
     * @param $id
     * @param $data
     * @return mixed
     * @throws ItemNotFoundException
     */
    function update($id, $data)
    {
        $article = $this->user->find($id);
        if ($article == null)
            return $this->commonService->errorCustomError($this->itemNotFound(), null, ConstantStatusService::NOTFOUNDSTATUS);

        $article->update($data);
        return $article;

    }

    /**
     * @param $id
     * @return mixed
     * @throws ItemNotFoundException
     */
    function deleteByID($id)
    {
        $article = $this->user->find($id);

        if ($article == null)
            return $this->commonService->errorCustomError($this->itemNotFound(), null, ConstantStatusService::NOTFOUNDSTATUS);

        return $article->delete();

    }

    /**
     * @param $user_id
     * @param $token
     * @return mixed
     */
    function saveToken($user_id, $token)
    {
        $data['user_id'] = $user_id;
        $data['token'] = $token;
        $data['revoked'] = false;
        $data['expiry_time'] = Carbon::now()->addHour(1);

        return ApiUserToken::create($data);
    }

    /**
     * check unique token
     * @param $token
     * @return mixed
     */
    function checkUniqueToken($token)
    {
        $userToken = $this->apiUserToken->where('token', $token)->first();
        if (is_null($userToken)) {
            return $token;
        } else {
            $token = EkHelper::randomPassword($length = 6, $add_dashes = false, $available_sets = 'ud');
            $this->checkUniqueToken($token);
        }

    }

    /**
     * @param $user
     * @param $oldPassword
     * @param $newPassword
     * @return bool
     */
    function checkOldPassword($user, $oldPassword, $newPassword)
    {
        if (Hash::check($oldPassword, $user->password)) {

            $data['password'] = bcrypt($newPassword);
            $user->update(['password' => $data['password']]);

            return true;
        } else {
            return false;
        }

    }

    /**
     *
     * @param $token
     * @param $password
     * @return
     */
    public function checkToken($token, $password)
    {

        $password = bcrypt($password);
        $userToken = $this->apiUserToken->where('token', $token)->first();
        if (is_null($userToken)) {
            return null;
        } else {
            if ($userToken['expiry_time'] >= Carbon::now()) {
                $user = ApiUser::find($userToken->user['id']);
                $user->update(['password' => $password]);
                return $user;

            } else {
                return null;
            }
        }


    }


    public function changepassword($user,$password)
    {

        if(isset($password))  {
            $data['password'] = bcrypt($password);
            $user->update(['password' => $data['password']]);

            return true;
        } else {
            return false;
        }
    }


}