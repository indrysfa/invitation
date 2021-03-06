@extends('wedding.layouts.app')
@section('title', 'Contact - ')
@section('meta')
    <meta name="description" content="Jika ada pertanyaan silahkan hubungi kami" />
@endsection
@section('navbar')
    <div class="col-xs-10 text-right menu-1">
        <ul>
            <li><a href="{{ route('front.data.wish', $slug->slug) }}">Home</a></li>
            <li><a href="{{ route('front.data.gallery', $slug->slug) }}">Gallery</a></li>
            <li class="active"><a href="{{ route('front.data.contact', $slug->slug) }}">Contact</a></li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="fh5co-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-md-push-6 animate-box">
                    <h3>Get In Touch</h3>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    <form action="{{ route('post.contact', $slug->slug) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="fname">Name</label>
                                <input type="text" id="name" name="name" class="form-control" placeholder="Your name"
                                    required oninvalid="this.setCustomValidity('Please fill in your name')"
                                    oninput="setCustomValidity('')">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="email">Email (required not publish)</label>
                                <input type="text" id="email" name="email" class="form-control"
                                    placeholder="Your email address" required
                                    oninvalid="this.setCustomValidity('Please fill in your email')"
                                    oninput="setCustomValidity('')">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="phone">Phone/WA (required not publish)</label>
                                <input type="number" id="phone" name="phone" class="form-control"
                                    placeholder="Your phone number" required
                                    oninvalid="this.setCustomValidity('Please fill in your number phone')"
                                    oninput="setCustomValidity('')">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-md-12">
                                <label for="message">Message</label>
                                <textarea name="message" id="message" name="message" cols="30" rows="10"
                                    class="form-control" placeholder="Write us something" required
                                    oninvalid="this.setCustomValidity('Please fill in your message')"
                                    oninput="setCustomValidity('')"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary">
                        </div>

                    </form>
                </div>
                <div class="col-md-5 col-md-pull-5 animate-box">

                    <div class="fh5co-contact-info">
                        <h3>Contact Information</h3>
                        <ul>
                            <li class="address">{{ $contact_info->address }}</li>
                            <li class="phone"><a target="_blank" href="tel://{{ $contact_info->phone }}">+
                                    {{ $contact_info->phone }}</a></li>
                            <li class="email"><a target="_blank"
                                    href="https://api.whatsapp.com/send?phone=62{{ $contact_info->wa }}&text=Saya%0Aingin%0Abertanya%0Amengenai%0Aacara%0Apernikahan%0Akamu">+
                                    {{ $contact_info->wa }}</a></li>
                            <li class="email"><a target="_blank"
                                    href="mailto:{{ $contact_info->email }}">{{ $contact_info->email }}</a>
                            </li>
                            <li class="icon-facebook"><a target="_blank"
                                    href="https://www.facebook.com/{{ $contact_info->facebook }}">{{ $contact_info->facebook }}</a>
                            </li>
                            <li class="icon-instagram"><a target="_blank"
                                    href="https://www.instagram.com/{{ $contact_info->instagram }}">{{ $contact_info->instagram }}</a>
                            </li>
                            <li class="icon-twitter" aria-hidden="true"><a target="_blank"
                                    href="https://twitter.com/{{ $contact_info->twitter }}">{{ $contact_info->twitter }}</a>
                            </li>
                        </ul>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
