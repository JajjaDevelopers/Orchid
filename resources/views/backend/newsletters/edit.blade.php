@extends('backend.layouts.dashboard.main')
<!--title section-->
@section('title')
    {{ $page_title }}
@endsection

<!--main content section-->
@section('content')
@include('backend.layouts.dashboard.common_nav')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Newsletter</h2>
                </div>
                <div class="card-body">

                    @if (session('error'))
                        <div class="alert alert-danger">
                            <span> {{ session('error') }} </span>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.newsletter.update', $newsletter->id) }}">
                        @csrf
                        @method('PUT') <!-- Use PUT for updating -->

                        <!-- Subject -->
                        <div class="form-group mb-3">
                            <label for="subject">Newsletter Subject</label>
                            <input type="text" name="subject" id="subject" class="form-control"
                                placeholder="Enter the newsletter subject"
                                value="{{ old('subject', $newsletter->subject) }}" required>
                            @error('subject')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="form-group">
                            <label for="content">Newsletter Content</label>
                            <textarea name="content" id="content" class="form-control" rows="5" placeholder="Write content here">{{ old('content', $newsletter->content) }}</textarea>
                            @error('content')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Attachments -->
                        {{-- <div class="form-group mb-3" id="attachments">
                            <label for="attachments[]">Attachment Links (Google Drive)</label>
                            @foreach (old('attachments', $newsletter->attachments ?? []) as $attachment)
                                <input type="url" name="attachments[]" class="form-control mb-2"
                                    placeholder="Enter Google Drive link" value="{{ $attachment }}">
                            @endforeach
                            <input type="url" name="attachments[]" class="form-control mb-2"
                                placeholder="Enter Google Drive link">
                            @error('attachments.*')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="button" onclick="addAttachmentField()" class="btn btn-secondary mb-3">Add Another
                            Link</button> --}}

                        <!-- Attachments -->
                        <div class="form-group mb-3" id="attachments">
                            <label for="attachments[]">Attachment Links (Google Drive)</label>
                            @foreach (old('attachments', $newsletter->attachments ?? []) as $attachment)
                                <input type="url" name="attachments[]" class="form-control mb-2"
                                    placeholder="Enter Google Drive link" value="{{ $attachment }}">
                            @endforeach
                            @error('attachments.*')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="button" onclick="addAttachmentField()" class="btn btn-primary btn-sm mb-3" data-toggle="tooltip-primary" title="Add New Link"><i class="fas fa-plus"></i></button>
                        <div class="form-group mb-3" id="video_urls">
                            <label for="video_urls[]">Video Url (Optional)</label>
                            @foreach (old('video_urls', $newsletter->video_urls ?? []) as $video_url)
                                <input type="url" name="video_urls" class="form-control mb-2"
                                    placeholder="Enter video Url" value="{{ $video_url }}">
                            @endforeach
                            @error('video_urls.*')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="button" onclick="addVideoField()" class="btn btn-primary btn-sm mb-3" data-toggle="tooltip-primary" title="Add New Video Link"><i class="fas fa-plus"></i></button>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.newsletter.view') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                            <span id="updateNewsletterText">Update Newsletter</span>
                            <span class="spinner-border spinner-border-sm d-none" role="status" id="addNewsletterSpinner"
                                aria-hidden="true"></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @include('backend.components.common')
    <script>
        function addAttachmentField() {
            const div = document.createElement('div');
            div.classList.add('form-group', 'mb-2', 'd-flex', 'align-items-center');

            div.innerHTML = `
               <input type="url" name="attachments[]" class="form-control me-2" placeholder="Enter Google Drive link">
               <button type="button" class="btn btn-danger btn-sm delete-field">X</button>
           `;

            document.getElementById('attachments').appendChild(div);

            div.querySelector('.delete-field').addEventListener('click', function() {
                div.remove();
            });
        }

        function addVideoField() {
            const div = document.createElement('div');
            div.classList.add('form-group', 'mb-2', 'd-flex', 'align-items-center');
            div.innerHTML = `
               <input type="url" name="video_urls[]" class="form-control" placeholder="Enter Video url">
               <button type="button" class="btn btn-danger btn-sm delete-video-field">X</button>
           `;
            document.getElementById('video_urls').appendChild(div);
            div.querySelector('.delete-video-field').addEventListener('click', function() {
                div.remove();
            });
        }
        $(document).ready(function() {

            //adding loading spinner
            $('#addNewsletterForm').on('submit', function() {
                const $updateNewsletterBtn = $('#updateNewsletterBtn');
                const $updateNewsletterText = $('#updateNewsletterText');
                const $addNewsletterSpinner = $('#addNewsletterSpinner');

                // Disable button and show spinner
                $updateNewsletterBtn.prop('disabled', true);
                $updateNewsletterText.addClass('d-none');
                $addNewsletterSpinner.removeClass('d-none');
            });
        });
    </script>
@endsection
