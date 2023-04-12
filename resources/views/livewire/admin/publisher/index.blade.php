<div>
    @include('livewire.admin.publisher.modal-form')

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Publishers
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addPublisherModal"
                            class="btn btn-primary btn-sm text-white float-end">Add
                            Publisher</a>
                    </h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($publishers as $publisher)
                            <tr>
                                <td>{{ $publisher->id }}</td>
                                <td>{{ $publisher->name }}</td>
                                <td>{{ $publisher->slug }}</td>
                                <td>{{ $publisher->status == '1' ? 'Hidden':'Visible'}}</td>
                                <td>
                                    <a href="#"
                                        wire:click="editPublisher({{ $publisher->id }})"
                                        data-bs-toggle="modal" data-bs-target="#updatePublisherModal"
                                        class="btn btn-primary text-white">Edit</a>
                                    <a href="#"
                                        wire:click="deletePublisher({{ $publisher->id }})"
                                        data-bs-toggle="modal" data-bs-target="#deletePublisherModal"
                                        class="btn btn-danger text-white">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5"> No Publishers Found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div>
                        {{ $publishers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
    <script>
        window.addEventListener('close-modal', event => {
            $('#addPublisherModal').modal('hide');
            $('#updatePublisherModal').modal('hide');
            $('#deletePublisherModal').modal('hide');
        });
    </script>
@endpush
