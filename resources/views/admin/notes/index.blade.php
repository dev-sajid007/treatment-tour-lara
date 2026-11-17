@extends('layouts.admin')
    @section('title', 'Notes')
    @section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 mx-auto">
                <div class="d-flex justify-content-between align-items-center">
                    <h3>Notes</h3>
                    <button type="button" class="btn btn-primary" onclick="openAddModal()">
                        Add Note
                    </button>
                </div>

                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger mt-3">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="row mt-4">
                    @foreach($notes as $note)
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $note->title }}</h5>
                                    <p class="card-text"><b>Created Date: </b>{{ $note->created_at->format('d-M-Y') }}</p>
                                    <button class="btn btn-info" onclick="openViewModal({{ $note->id }})"><i class="fas fa-eye"></i></button>
                                    <button class="btn btn-primary" onclick="openEditModal({{ $note->id }})"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger" onclick="deleteNoteModal({{ $note->id }})"><i class="fas fa-trash"></i></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Note Modal for Adding and Editing -->
                <div class="modal fade modal-lg" id="noteModal" tabindex="-1" role="dialog" aria-labelledby="noteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="noteModalLabel">Add Note</h5>
                                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="noteForm" method="POST" onsubmit="return validateForm()">
                                    @csrf
                                    <input type="hidden" id="note_id" name="id">
                                    <input type="hidden" name="_method" id="form_method" value="POST">
                                    <div class="form-group">
                                        <label for="title">Note Title</label>
                                        <input type="text" id="title" name="title" class="form-control" required>
                                    </div>
                                    <div class="form-group mt-3">
                                        <label for="description">Description</label>
                                        <div id="description-editor" style="height: 200px;"></div>
                                        <textarea id="description" name="description" class="form-control" style="display:none;"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-success mt-3">Save Note</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Note Modal for Viewing -->
                <div class="modal fade modal-lg" id="viewNoteModal" tabindex="-1" role="dialog" aria-labelledby="viewNoteModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="viewNoteModalLabel">View Note</h5>
                                <button type="button" class="close btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true"></span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="view_title">Note Title</label>
                                    <input type="text" id="view_title" class="form-control" readonly>
                                </div>
                                <div class="form-group mt-3">
                                    <label for="view_description">Description</label>
                                    <div id="view_description" class="form-control" readonly style="min-height: 200px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Note Form -->
                <form id="deleteNoteForm" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>

            </div>
        </div>
    </div>


    <script>
        var quill;
        var viewQuill;
        document.addEventListener('DOMContentLoaded', function() {
            quill = new Quill('#description-editor', {
                theme: 'snow'
            });

            viewQuill = new Quill('#view_description', {
                theme: 'bubble',
                readOnly: true,
                modules: {
                    toolbar: false
                }
            });

            var noteForm = document.getElementById('noteForm');
            noteForm.onsubmit = function() {
                var description = document.querySelector('textarea[name=description]');
                description.value = quill.root.innerHTML;
            };
        });

        function openAddModal() {
            document.getElementById('noteForm').reset();
            quill.root.innerHTML = '';
            document.getElementById('note_id').value = '';
            document.getElementById('form_method').value = 'POST';
            document.getElementById('noteForm').action = '{{ route('notes.store') }}';
            document.getElementById('noteModalLabel').innerText = 'Add Note';
            $('#noteModal').modal('show');
        }

        function openEditModal(noteId) {
            fetch(`/notes/${noteId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('title').value = data.title;
                    quill.root.innerHTML = data.description;
                    quill.root.style.height = '200px';  // Set height to 200px for edit modal
                    document.getElementById('note_id').value = data.id;
                    document.getElementById('form_method').value = 'PUT';
                    document.getElementById('noteForm').action = `/notes/${noteId}`;
                    document.getElementById('noteModalLabel').innerText = 'Edit Note';
                    $('#noteModal').modal('show');
                })
                .catch(error => console.error('Error:', error));
        }

        function openViewModal(noteId) {
            fetch(`/notes/${noteId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('view_title').value = data.title;
                    viewQuill.root.innerHTML = data.description;
                    $('#viewNoteModal').modal('show');
                })
                .catch(error => console.error('Error:', error));
        }

        function deleteNoteModal(noteId) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteNoteForm').action = `/notes/${noteId}`;
                    document.getElementById('deleteNoteForm').submit();
                }
            })
        }

        function validateForm() {
            var description = quill.root.innerHTML;
            if (description.trim() === '') {
                alert('Description is required.');
                return false;
            }
            return true;
        }
    </script>
@endsection
