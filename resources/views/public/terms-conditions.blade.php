@extends('layouts.public')

@section('title', 'Terms & Conditions')

@section('content')

<section class="bg-slate-50 py-20">
    <div class="container mx-auto max-w-4xl px-4">

        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-slate-900">
                Terms & Conditions
            </h1>

            <p class="mt-4 text-slate-600">
                Please read these terms carefully before using our website and services.
            </p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border p-8 space-y-8">

            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-3">
                    1. Acceptance of Terms
                </h2>

                <p class="text-slate-600 leading-relaxed">
                    By accessing and using this website, you accept and agree
                    to be bound by these Terms and Conditions. If you do not
                    agree with any part of these terms, please discontinue use
                    of our website.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-3">
                    2. Services
                </h2>

                <p class="text-slate-600 leading-relaxed">
                    We provide web development, software development,
                    consulting, and digital solutions. Any project agreements,
                    pricing, timelines, and deliverables will be governed by
                    separate contracts between us and our clients.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-3">
                    3. Intellectual Property
                </h2>

                <p class="text-slate-600 leading-relaxed">
                    All content on this website including text, graphics,
                    logos, designs, source code, and media is the property of
                    the company unless otherwise stated and is protected by
                    applicable copyright laws.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-3">
                    4. User Responsibilities
                </h2>

                <ul class="list-disc pl-6 text-slate-600 space-y-2">
                    <li>Provide accurate information when submitting forms.</li>
                    <li>Do not misuse or attempt to disrupt the website.</li>
                    <li>Do not upload malicious content or harmful software.</li>
                    <li>Comply with all applicable laws and regulations.</li>
                </ul>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-3">
                    5. Third-Party Links
                </h2>

                <p class="text-slate-600 leading-relaxed">
                    Our website may contain links to third-party websites.
                    We are not responsible for the content, privacy policies,
                    or practices of any external websites.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-3">
                    6. Limitation of Liability
                </h2>

                <p class="text-slate-600 leading-relaxed">
                    We shall not be liable for any indirect, incidental,
                    special, or consequential damages arising from the use
                    of this website or our services.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-3">
                    7. Privacy
                </h2>

                <p class="text-slate-600 leading-relaxed">
                    Your use of this website is also governed by our Privacy
                    Policy. We encourage you to review it for information
                    regarding data collection and usage.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-3">
                    8. Modifications
                </h2>

                <p class="text-slate-600 leading-relaxed">
                    We reserve the right to modify these Terms & Conditions
                    at any time without prior notice. Continued use of the
                    website after changes are posted constitutes acceptance
                    of the revised terms.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-3">
                    9. Governing Law
                </h2>

                <p class="text-slate-600 leading-relaxed">
                    These Terms & Conditions shall be governed by and
                    interpreted in accordance with the laws of Nepal.
                </p>
            </div>

            <div>
                <h2 class="text-xl font-semibold text-slate-900 mb-3">
                    10. Contact Information
                </h2>

                <p class="text-slate-600 leading-relaxed">
                    If you have questions regarding these Terms & Conditions,
                    please contact us through our Contact page.
                </p>
            </div>

            <div class="pt-6 border-t">
                <p class="text-sm text-slate-500">
                    Last Updated: {{ now()->format('F d, Y') }}
                </p>
            </div>

        </div>

    </div>
</section>

@endsection