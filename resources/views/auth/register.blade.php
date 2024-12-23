@extends ("layouts.auth-master")

@section('content')

    <form action="/registration" method="post" class="col-lg-6 offset-lg-3 ">
        @csrf
        <div class="form-group mb-2">
            <label for="">User Name</label>
            <input type="text" name="name" class="form-control" value="{{old('name')}}" placeholder="Enter Your Name" >
            
            @if ($errors->has('name'))

                <span class="text-danger">
                    {{$errors->first('name')}}
                </span>
            
            @endif
        </div>

        <div class="form-group mb-2">
        <label for="">Email</label>
        <input type="email" name="email" class="form-control" value="{{old('email')}}"
         placeholder="Enter Your Email">

         @if ($errors->has('email'))

                <span class="text-danger">
                    {{$errors->first('email')}}
                </span>
            
            @endif
        </div>

        <div class="form-group mb-2">
        <label for="">Password</label>
        <input type="password" name="password" class="form-control" value="{{old('password')}}"
         placeholder="Enter Your Password">

         @if ($errors->has('password'))

                <span class="text-danger">
                    {{$errors->first('password')}}
                </span>
            
            @endif
        </div>

        <div class="form-group mb-2">
        <label for="">Confirm Password</label>
        <input type="password" name="confirm_password" class="form-control" 
        placeholder="Enter Your Password">

        @if ($errors->has('confirm_password'))

                <span class="text-danger">
                    {{$errors->first('confirm_password')}}
                </span>
            
            @endif
        </div>

        <button type="submit" class="btn btn-md btn-dark">Submit</button>
        <a href="/" class="btn btn-md btn-secondary">Cancel</a>

    </form>

@endsection