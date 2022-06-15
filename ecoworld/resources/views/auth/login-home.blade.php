@extends('home')

@section('login-modal')
    <script type="text/javascript">
       const loginsignInModal = document.querySelector("#signIn-modal");
       if (loginsignInModal !== null) {
           loginsignInModal.querySelector(".close").onclick = () => {
               loginsignInModal.style.display = "none";
           };
           loginsignInModal.style.display = 'flex';
       }
    </script>
@endsection
