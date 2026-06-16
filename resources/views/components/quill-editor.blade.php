@props(['id', 'name', 'value' => ''])

<div class="quill-wrapper mb-4">
    <div id="{{ $id }}-quill-box" class="quill-editor-instance">
        {!! $value !!}
    </div>

    <input type="hidden" name="{{ $name }}" id="{{ $id }}-hidden" value="{!! e($value) !!}">
</div>

@once
    {{-- Push the styling sheet to the header stack only once per page rendering --}}
    @push('styles')
    <link href="https://cdn.quilljs.com/1.3.7/quill.snow.css" rel="stylesheet">
    <style>
        .ql-toolbar.ql-snow {
            border-color: #e2e8f0 !important;
            background-color: #f8fafc !important;
            border-top-left-radius: 0.75rem !important;
            border-top-right-radius: 0.75rem !important;
            padding: 0.75rem !important;
        }
        .ql-container.ql-snow {
            border-color: #e2e8f0 !important;
            border-bottom-left-radius: 0.75rem !important;
            border-bottom-right-radius: 0.75rem !important;
            font-family: inherit;
        }
        .ql-editor {
            min-height: 250px;
            font-size: 0.875rem;
            color: #1e293b;
        }
        .ql-editor.ql-blank::before {
            color: #94a3b8 !important;
            font-style: normal !important;
        }
    </style>
    @endpush

    {{-- Push the JS core file instance asset to the footer script stack --}}
    @push('scripts')
    <script src="https://cdn.quilljs.com/1.3.7/quill.min.js"></script>
    @endpush
@endonce

{{-- Push instances instantiation scripts inline to load elements cleanly --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const boxSelector = '#{{ $id }}-quill-box';
    const inputHidden = document.getElementById('{{ $id }}-hidden');

    const quill = new Quill(boxSelector, {
        theme: 'snow',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline'],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'clean']
            ]
        }
    });

    // Automatically synchronize inner content to hidden form state whenever text variations change
    quill.on('text-change', function() {
        inputHidden.value = quill.root.innerHTML;
    });
});
</script>
@endpush