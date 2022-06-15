@extends('home')

@section('register-modal')
    <script type="text/javascript">
        const signUpModal = document.querySelector("#signUp-modal");
        if (signUpModal !== null) {
            signUpModal.querySelector(".close").onclick = () => {
                signUpModal.style.display = "none";
            };
            signUpModal.style.display = 'flex';
        }
    </script>
@endsection
