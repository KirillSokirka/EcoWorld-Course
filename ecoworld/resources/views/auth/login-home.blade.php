@extends('home')

@section('login-modal')
    <script type="text/javascript">
       const signInModal = document.querySelector("#signIn-modal");
       if (signInModal !== null) {
           signInModal.querySelector(".close").onclick = () => {
               signInModal.style.display = "none";
           };
           signInModal.style.display = 'flex';
       }
    </script>
@endsection
