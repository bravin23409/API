<?php
class forms{
    private function submit_button($text){
        print "<input type='submit' value='$text'>";
    }


    public function signup(){
        ?>
         <h1>Signup Form</h1>
         <form action='' method='post'>
         Name: <input type='text' name='name'><br>
         Email: <input type='email' name='email'><br>
            Password: <input type='password' name='password'><br>
            <?php $this ->submit_button('Sign up'); ?>
         <?php $this->submit_button('Sign up'); ?>Already have an account? <a href='login.php'>Login</a>
         </form>
         <?php
    }
    public function login(){
        ?>
         <h1>Login Form</h1>
         <form action='' method='post'>
         Email: <input type='email' name='email'><br>
            Password: <input type='password' name='password'><br>
         <?php $this->submit_button('Login'); ?>
         </form>
         <?php
    }
}