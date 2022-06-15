@extends('home')

@section('register-modal')
    <script type="text/javascript">
        const registerSignUpModal = document.querySelector("#signUp-modal");
        if (registerSignUpModal !== null) {
            registerSignUpModal.querySelector(".close").onclick = () => {
                registerSignUpModal.style.display = "none";
            };
            registerSignUpModal.style.display = 'flex';
        }
    </script>
@endsection
