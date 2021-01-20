@foreach ($company->coaches as $coach)
    <div class="col-md-3">
        <div class="card card-profile-1 mb-4">
            <div class="card-body text-center">
                <div class="avatar box-shadow-2 mb-3">
                    <img src="{{asset('assets/images/faces/16.jpg')}}" alt="">
                </div>
                <h5 class="m-0">{{ $coach->user->name }}</h5>
                <p class="mt-0">UI/UX Designer</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Recusandae cumque.
                </p>
                <button class="btn btn-primary btn-rounded">Contact Jassica</button>
                <div class="card-socials-simple mt-4">
                    <a href="">
                        <i class="i-Linkedin-2"></i>
                    </a>
                    <a href="">
                        <i class="i-Facebook-2"></i>
                    </a>
                    <a href="">
                        <i class="i-Twitter"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endforeach
