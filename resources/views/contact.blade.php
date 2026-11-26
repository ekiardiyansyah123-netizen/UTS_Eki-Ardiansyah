
@extends('layouts.app')

@section('title', 'Contact')

@section('content')

<section class="page-hero">
    <div class="container">
        <span class="section-label">WE WOULD LOVE TO SEE YOU</span>

        <h1>Say <em>hello.</em></h1>

        <p>
            Come for the coffee. Stay for the good vibes.
        </p>
    </div>
</section>

<section class="section contact-section">
    <div class="container contact-grid">

        <div class="contact-content">
            <span class="section-label">GET IN TOUCH</span>

            <h2>
                Let's make<br>
                <em>good moments.</em>
            </h2>

            <p>
                Whether you're looking for your favorite coffee,
                want to visit us, or simply want to say hello,
                we're always happy to hear from you.
            </p>

            <div class="contact-information">

                <div class="contact-item">
                    <span class="contact-icon">⌖</span>
                    <div>
                        <strong>Our Location</strong>
                        <p>Bandar Lampung, Indonesia</p>
                    </div>
                </div>

                <div class="contact-item">
                    <span class="contact-icon">◷</span>
                    <div>
                        <strong>Opening Hours</strong>
                        <p>Every day, 09.00 – 22.00 WIB</p>
                    </div>
                </div>

                <div class="contact-item">
                    <span class="contact-icon">✉</span>
                    <div>
                        <strong>Email</strong>
                        <p>hello@essenzacoffee.com</p>
                    </div>
                </div>

            </div>

        </div>

        <div class="contact-form-card">

            <span class="section-label">SEND US A MESSAGE</span>

            <form action="#" method="POST">

                <div class="form-group">
                    <label for="name">Your name</label>
                    <input type="text" id="name" placeholder="Enter your name">
                </div>

                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" id="email" placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" placeholder="What is this about?">
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" rows="5" placeholder="Write your message here..."></textarea>
                </div>

                <button type="button" class="btn btn-dark form-button">
                    Send Message <span>↗</span>
                </button>

            </form>

        </div>

    </div>
</section>

@endsection
