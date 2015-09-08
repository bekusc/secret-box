<?php namespace app\models;

class User
{
    private $_db,
            $_data,
            $_sessionName;

    public $logged;

    function __construct($user = null)
    {
        $this->_db = \DB::run();
        $this->_sessionName = \Config::get('session:session_name');

        if (!$user) {
            
            $user_id = \Session::get($this->_sessionName);
            $user = $this->_db->find('users', $user_id);

            if($user) {
                $this->logged = true;
                $this->_data = $user;
            }
        }
        else {
            $this->_data = $this->_db->find('users', $user); 
        }
    }

    public function create(array $fields) {

        if(!$this->_db->insert('users', $fields)) {
            die('This user can not be created!');
        }
    }

    public function login($username = null, $password = null, $remember = false) {

        if (isset($this->_data->id) && empty($username)) {

            \Session::put($this->_sessionName, $this->_data->id);
            $this->logged = true;

            return true;
        }


        if ($user = $this->_db->find('users', $username)) {

            $password = \Hash::make($password, $user->salt);
            
            if ($password === $user->password) {
                \Session::put($this->_sessionName, $user->id);
                $this->logged = true;

                if ($remember) {
                    $user_hash = $this->_db->get('users_session', ['user_id', '=', $user->id])->first();
                    $hash = \Hash::unique();

                    if ($user_hash) {
                        $hash = $user_hash->hash;
                    }
                    else {
                        $this->_db->insert('users_session', [
                            'user_id' => $user->id,
                            'hash' => $hash
                        ]);
                    }
                    \Cookie::put(\Config::get('remember:cookie_name'), $hash, \Config::get('remember:cookie_expiry'));
                }
                
                return true;
            }
        }

        return false;
    }

    public function logout() {

        $this->_db->delete('users_session', ['user_id', '=', $this->_data->id]);

        \Session::delete($this->_sessionName);
        \Cookie::delete(\Config::get('remember:cookie_name'));
    }

    public function update(array $feilds, $id = null) {

        if (!$id) {
            $id = $this->_data->id;
        }
        return $this->_db->update('users', $id, $feilds);
    }

    public function role($role) {
        if ($this->logged) {
            
            $group = $this->_db->get('groups', ['id', '=', $this->_data->group_id])->first();
            
            if($group) {
                $permissions = json_decode($group->permissions, true);

                return @($permissions[$role] === 1);
            }
        }

        return false;
    }

    public function avatar($file) {

        $type = pathinfo($file['name'],PATHINFO_EXTENSION);
        $mimes = ['gif', 'jpeg', 'png'];
        
        $dir = BASEPATH . '/public/img/';
        $name = time() . '_' . md5(microtime()) . '.' . $type;

        if (!empty($file["tmp_name"])) {

            $image = getimagesize($file["tmp_name"]);
            
            if ($image) {
                if (in_array($type, $mimes)) {
                    if (move_uploaded_file($file["tmp_name"], $dir . $name)) {
                        
                        if ($this->_data->avatar !== 'default.png') {
                            unlink($dir . $this->_data->avatar);
                        }
                        return $this->_db->update('users', $this->_data->id, ['avatar' => $name]);
                    }
                }
            }
        }

        return false;
    }

    public function get() {

        return $this->_data;
    }

    public static function loginUser()
    {
        if (\Cookie::exists(\Config::get('remember:cookie_name')) && !\Session::exists(\Config::get('session:session_name'))) {
    
            $hash = \Cookie::get(\Config::get('remember:cookie_name'));
            $get_hash = \DB::run()->get('users_session', ['hash', '=', $hash])->first();

            if ($get_hash) {
                $user = new self($get_hash->user_id);
                $user->login();
            }
        }
    }

}