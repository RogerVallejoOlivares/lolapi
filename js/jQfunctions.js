(function($) {

    $('#registerUser').submit(function (e) {
        if(isEmail() && passwordsMatch()){

        }else{
            e.preventDefault();
        }
    });

    $('#signUp').on('shown.bs.modal', function (e) {
        console.log("a");
    });

    function isEmail() {
        const mail = document.getElementById('emailSign');
        const regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

        var check = regex.test(mail.value);

        if(!check)  mail.classList.add('wrongValue');
        else        mail.classList.remove('wrongValue');

        return check;
    }

    function passwordsMatch(){
        const pwd = document.getElementById('pwdSign');
        const pwd2 = document.getElementById('pwd2Sign');

        var check = pwd.value === pwd2.value;

        if(!check){
            pwd.classList.add('wrongValue');
            pwd2.classList.add('wrongValue');
        }else{
            pwd.classList.remove('wrongValue');
            pwd2.classList.remove('wrongValue');
        }

        return check;
    }
});

