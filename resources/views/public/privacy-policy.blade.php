@extends('layouts.public')

@section('title', 'Privacy Policy')

@section('content')

<section class="bg-slate-50 py-16">
    <div class="container mx-auto px-4 max-w-4xl">

        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-slate-900">
                Privacy Policy
            </h1>

            <p class="mt-4 text-slate-600">
                Last Updated: {{ now()->format('F d, Y') }}
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 prose max-w-none">

            <h2>1. Introduction</h2>
            <p>
                AstraCore Business Suite values your privacy and is committed
                to protecting your personal information. This Privacy Policy
                explains how we collect, use, and safeguard your information
                when you visit our website.
            </p>

            <h2>2. Information We Collect</h2>

            <p>We may collect the following information:</p>

            <ul>
                <li>Name</li>
                <li>Email Address</li>
                <li>Phone Number</li>
                <li>Company Information</li>
                <li>Messages submitted through our contact form</li>
                <li>Website usage analytics</li>
            </ul>

            <h2>3. How We Use Your Information</h2>

            <p>Your information may be used to:</p>

            <ul>
                <li>Respond to inquiries and support requests</li>
                <li>Provide requested services</li>
                <li>Improve website performance and user experience</li>
                <li>Send updates regarding our services</li>
                <li>Maintain security and prevent fraud</li>
            </ul>

            <h2>4. Contact Forms</h2>

            <p>
                Information submitted through our contact forms is stored
                securely and used solely for communication regarding your
                inquiry.
            </p>

            <h2>5. Cookies</h2>

            <p>
                Our website may use cookies and analytics technologies to
                improve user experience and monitor website performance.
            </p>

            <h2>6. Third-Party Services</h2>

            <p>
                We may use third-party services such as Google Analytics,
                hosting providers, or email providers. These services may
                process limited user data as required to provide their
                functionality.
            </p>

            <h2>7. Data Security</h2>

            <p>
                We implement reasonable security measures to protect your
                information against unauthorized access, disclosure, or loss.
            </p>

            <h2>8. Data Retention</h2>

            <p>
                We retain submitted information only as long as necessary
                to provide services or comply with legal obligations.
            </p>

            <h2>9. Your Rights</h2>

            <p>
                You may request access, correction, or deletion of your
                personal information by contacting us directly.
            </p>

            <h2>10. Contact Us</h2>

            <p>
                If you have any questions regarding this Privacy Policy,
                please contact us:
            </p>

            <ul>
                <li>Email: {{ $setting->email ?? 'info@astracore.com' }}</li>
                <li>Phone: {{ $setting->phone ?? '+977-9800000000' }}</li>
                <li>Address: {{ $setting->address ?? 'Kathmandu, Nepal' }}</li>
            </ul>

        </div>

    </div>
</section>

@endsection