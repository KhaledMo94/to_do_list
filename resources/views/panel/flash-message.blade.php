@if (session()->has('success'))
<div class="bg-success text-white p-3 m-3">
    {{ session('success')}}
</div>
@endif
@if (session()->has('danger'))
<div class="bg-danger text-white p-3 m-3" >
    {{ session('danger')}}
</div>
@endif