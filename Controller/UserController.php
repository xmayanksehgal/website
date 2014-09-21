<?php
    
    namespace Controller;

    use \Everyman\Neo4j\Cypher\Query;
    use \Everyman\Neo4j\Node;
    use \View\View;
    use \Model\User;
    use \Model\SkillManager;
    use \Model\UserManager;
    use \Symfony\Component\Routing\Generator\UrlGenerator;
    use \Controller\Router;
    use \Utils\SecurityHelper as SH;

    class UserController extends Controller {

        /**
         * Show login form and handles it
         */
        public function loginAction(){
            //for the view
            $params = array("title" => "Sign in");

            //handle login form
            if (!empty($_POST)){

                $error = true;

                $loginUsername = $_POST['loginUsername'];
                $password = $_POST['password'];

                //validation
                $validator = new \Model\Validator();

                $validator->validateLoginUsername($loginUsername);
                $validator->validatePassword($password);

                //if valid
                if ($validator->isValid()){

                    //find user from db
                    $userManager = new UserManager();
                    $user = $userManager->findByEmailOrUsername($loginUsername);

                    //if user found
                    if($user){

                        //hash password
                        $securityHelper = new SH();
                        $hashedPassword = $securityHelper->hashPassword( $password, $user->getSalt() );
                        
                        //compare hashed passwords
                        if ($hashedPassword === $user->getPassword()){
                            //login
                            $error = false;
                            $this->logUser($user);
                            Router::redirect(Router::url('home'));

                        }
                    }
                }

                if($error){
                    $params['error']['global'] = _("You username/email and password do not match");
                }
            }

            $view = new View("login.php", $params);
            $view->setLayout("../View/layouts/modal.php");
            $view->send();
        }

        private function logUser(User $user){
            SH::putUserDataInSession($user);
        }

        public function logoutAction(){
            $_SESSION['user'] = NULL;
            session_destroy();
            Router::redirect(Router::url('home'));
        }

        /**
         * Show registration form and handles it
         */
        public function registerAction(){
            //for the view
            $params = array("title" => "Sign up", "errors" => array());

            //handle register form
            if (!empty($_POST)){

                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
                $password_bis = $_POST['password_bis'];

                //validation
                $validator = new \Model\Validator();

                $validator->validateUsername($username);
                $validator->validateUniqueUsername($username);
                $validator->validateEmail($email);
                $validator->validateUniqueEmail($email);
                $validator->validatePassword($password);
                $validator->validatePasswordBis($password_bis, $password);

                if ($validator->isValid()){

                    //hydrate user obj
                    $securityHelper = new SH();
                    $user = new User();
                    
                    $user->setNewUuid();
                    $user->setUsername( $username );
                    $user->setEmail( $email );
                    $user->setEmailValidated(false);
                    $user->setRole( "user" );
                    $user->setSalt( SH::randomString() );
                    $user->setToken( SH::randomString() );

                    $hashedPassword = $securityHelper->hashPassword( $password, $user->getSalt() );
                    
                    $user->setPassword( $hashedPassword );
                    $user->setIpAtRegistration( $_SERVER['REMOTE_ADDR'] );
                    $user->setDateCreated( time() );
                    $user->setDateModified( time() );

                    //save it
                    $userManager = new \Model\UserManager();
                    $userManager->save($user); 
            
                    //send email confirmation message
                    $mailer = new Mailer();
                    $mailerResult = $mailer->sendConfirmation($user);

                    //log user in right now (will redirect home)
                    $this->logUser($user);
                    Router::redirect(Router::url('home'));

                }
                //not valid
                else {
                    $errors = $validator->getErrors();
                    $params["errors"] = $errors;
                }
            }

            $view = new View("register.php", $params);
            $view->setLayout("../View/layouts/modal.php");
            $view->send();
        }

        /**
         * Show the first forgot password form, handle it, and send a message
         */
        public function forgotPassword1Action(){

            $params = array();
            $params['title'] = _("Forgot your password ?");

            //handle forgot 1 form
            if (!empty($_POST)){

                $error = true;

                $loginUsername = $_POST['loginUsername'];

                //validation
                $validator = new \Model\Validator();

                $validator->validateLoginUsername($loginUsername);

                //if valid
                if ($validator->isValid()){

                    //find user from db
                    $userManager = new UserManager();
                    $user = $userManager->findByEmailOrUsername($loginUsername);

                    //if user found
                    if($user){
                        
                        //send a message
                        $mailer = new Mailer();
                        $mailerResult = $mailer->sendPasswordRecovery($user);

                    }
                }

                if($error){
                    $params['error']['global'] = _("This email or username is not valid.");
                }
            }

            $view = new View("forgot_password.php", $params);
            $view->setLayout("../View/layouts/modal.php");
            $view->send();
        }

        /**
         * Validates the token and email, then redirect to profile page with a modal new password form
         */
        public function forgotPassword2Action($email, $token){
            $userManager = new UserManager();
            $user = $userManager->findByEmail($email);
            if ($user){
                if ($user->getToken() === $token){
                    $user->setEmailValidated(true);
                    //change the token 
                    $user->setToken( SH::randomString() );
                    $userManager->update($user);
                    $this->logUser($user);
                    Router::redirect(Router::url("profileWithPassword", array("username" => $user->getUsername())));
                }
            }
            Router::fourofour();
        }



        /**
         * Show the first forgot password form, handle it, and send a message
         */
        public function changePasswordAction(){

            $params['title'] = _("CHANGE PASSWORD");

            //handle forgot 1 form
            if (!empty($_POST)){

                $error = true;
                $password = $_POST['password'];
                $password_bis = $_POST['password_bis'];

                //validation
                $validator = new \Model\Validator();

                $validator->validatePassword($password);
                $validator->validatePasswordBis($password_bis, $password);

                //if valid
                if ($validator->isValid()){
                    $securityHelper = new SH();

                    //find user from db
                    $user = $securityHelper->getUser();

                    //if user found
                    if($user){

                        $hashedPassword = $securityHelper->hashPassword( $password, $user->getSalt() );
                        $user->setPassword( $hashedPassword );

                        $userManager = new UserManager();
                        $userManager->update($user);

                        Router::redirect(Router::url('profile', array('username' => $user->getUsername())));

                    }
                }

                if($error){
                    $params['error']['global'] = _("This email or username is not valid.");
                }
            }

            $view = new View("change_password.php", $params);
            $view->setLayout("../View/layouts/modal.php");
            $view->send();
        }


        /**
         * Confirms an email adress after registration
        */
        public function emailConfirmationAction($email, $token){
            $userManager = new UserManager();
            $user = $userManager->findByEmail($email);
            if ($user){
                if ($user->getToken() === $token){
                    $user->setEmailValidated(true);
                    //change the token 
                    $user->setToken( SH::randomString() );
                    $userManager->update($user);
                }
            }
        }
    

        /**
         * Show the profile, but with the password modal opened
         */
        public function profileWithPasswordAction($username){
            $this->profileAction($username, true);
        }

        /**
         * Show the profile
         */
        public function profileAction($username, $withPassword = false){

            $userManager = new UserManager();
            $securityHelper = new SH();

            $profileUser = $userManager->findByUsername($username);
            $loggedUser = $securityHelper->getUser();

            $skillManager = new SkillManager();
            $latestActivity = $skillManager->getLatestActivity($profileUser);

            if (!$profileUser){
                Router::fourofour(_("This user never was born, or vanished."));
            }

            $uploadErrors = false;  
            $errors = false;
            //profile form submitted
            if (!empty($_POST) && $loggedUser){

                $newUsername = $_POST['username'];
                $newEmail = $_POST['email'];
                $bio = $_POST['bio'];
                $interests = $_POST['interests'];
                $languages = $_POST['languages'];
                $country = $_POST['country'];

                //validation
                $validator = new \Model\Validator();

                $validator->validateUsername($newUsername);
                //changing username ?
                if ($newUsername != $loggedUser->getUsername()){
                    $validator->validateUniqueUsername($newUsername);
                }
                $validator->validateEmail($newEmail);
                //changing email ?
                if ($newEmail != $loggedUser->getEmail()){
                    $validator->validateUniqueEmail($newEmail);
                }

                if ($validator->isValid()){

                    //hydrate user obj
                    $user = $securityHelper->getUser();

                    $user->setUsername( $newUsername );
                    $user->setEmail( $newEmail );
                    $user->setInterests( $interests );
                    $user->setLanguages( $languages );
                    $user->setCountry( $country );
                    $user->setBio( $bio );

                    if (!empty($_FILES['picture']['tmp_name'])){
                        //HANDLE UPLOAD
                        $tmp_name = $_FILES['picture']['tmp_name'];

                        $finfo = finfo_open(FILEINFO_MIME_TYPE);
                        $mime = finfo_file($finfo, $tmp_name);
                    
                        if (substr($mime, 0, 5) != "image"){
                            $uploadErrors[] = _("Your picture is invalid !");
                        }
                        else {
                            $img = new \abeautifulsite\SimpleImage($tmp_name);
                            if ($img->get_width() < 180 || $img->get_height() < 180){
                                $uploadErrors[] = _("Your picture is too small !");
                            }
                        }
                        
                        if (empty($uploadErrors)){
                            $filename = $loggedUser->getUuid() . ".jpg";
                            $img->thumbnail(180,180)->save("img/uploads/" . $filename, 100); //quality as second param
                            $user->setPicture( $filename );
                        }

                    }

                    $userManager->update($user);
                    $securityHelper->putUserDataInSession( $user );
                }
                else {
                    $errors = $validator->getErrors();
                }

            }

            $params = array();
            $params['errors'] = $errors;
            $params['uploadErrors'] = $uploadErrors;
            $params['latestActivity'] = $latestActivity;

            if ($withPassword){ $params['showPasswordResetForm'] = true; }
            $params['profileUser'] = $profileUser;
            $params['title'] = SH::encode($username) . _("'s profile | Skill Project");
            $view = new View("profile.php", $params);
            
            $view->send();
        
        }



        /**
         * The apply page
         */
        public function applyAction(){
            $view = new View("apply.php", array("title" => "Apply | Skill Project"));
            
            $view->send();
        }


    }