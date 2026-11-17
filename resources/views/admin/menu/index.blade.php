@extends('layouts.admin')
    <!-- Wrapper Start -->
    @section('title', 'Menu Items')
    @section('content')

 <div class="container-fluid">
    <div class="row">
        <div class="col-sm-10 mx-auto">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <div class="header-title">
                        <h3>{{ $menu->name }} Items</h3>
                    </div>
                    <div>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#menuItemModal">
                        Add Menu Item
                    </button>
    </div>
                </div>
                <div class="card-body">
                    <!-- Success or Error Messages -->
                    @if(session('success'))
                    <div class="alert text-white bg-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if ($errors->any())
                    <div class="alert text-white bg-danger" role="alert">
                        @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                        @endforeach
                    </div>
                    @endif
                    

                    <!-- Menu Items Table -->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Is Visible</th>
                                    <th>Icon</th>
                           
                                    <th>Sorting</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menuItems as $menuItem)
                                <tr>
                                    <td>{{ $menuItem->id }}</td>
                                    <td>{{ $menuItem->name }}</td>
                                    <td>{{ $menuItem->slug }}</td>
                                    <td>
                                        @if($menuItem->is_visible)
                                            <i class="fas fa-eye text-success"></i>
                                        @else
                                            <i class="fas fa-eye-slash text-danger"></i>
                                        @endif
                                    </td>
                                    <td>{!! $menuItem->icon !!}</td>

                                    <td>{{ $menuItem->sort }}</td>
                                    <td>
                                        <button class="btn btn-warning btn-sm" onclick="openEditModal({{ json_encode($menuItem) }})">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add/Edit Modal -->
<div class="modal fade" id="menuItemModal" tabindex="-1" aria-labelledby="menuItemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuItemModalLabel">Add/Edit Menu Item</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
           <form id="menuItemForm" action="" method="POST">
                @csrf
                @method('POST') <!-- Dynamically updated in openEditModal -->

                <input type="hidden" id="menuItemId" name="menu_item_id" value="">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="url" class="form-label">URL</label>
                        <input type="text" class="form-control" id="url" name="url" required>
                    </div>
                    <div class="mb-3">
                        <label for="icon" class="form-label">Icon</label>
                        <input type="text" class="form-control" id="icon" name="icon" required>
                    </div>
                    <div class="mb-3">
                        <label for="image" class="form-label">Image</label>
                        <input type="text" class="form-control" id="image" name="image" required>
                    </div>
                    <div class="mb-3">
                        <label for="is_visible" class="form-label">Is Visible</label>
                        <select class="form-control" id="is_visible" name="is_visible" required>
                            <option value="1">Visible</option>
                            <option value="0">Hidden</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="parent" class="form-label">Parent Menu Item</label>
                        <select class="form-control" id="parent" name="parent">
                            <option value="">No Parent</option>
                            @foreach($menu->menuItems as $menuItem)
                                <option value="{{ $menuItem->id }}">{{ $menuItem->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="sorting" class="form-label">Sorting</label>
                        <input type="number" class="form-control" id="sorting" name="sorting" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>

document.querySelector('[data-bs-target="#menuItemModal"]').addEventListener('click', function () {
    document.getElementById('menuItemForm').action = '/menu_items/store';

    // Reset form fields
    document.getElementById('menuItemId').value = '';
    document.getElementById('name').value = '';
    document.getElementById('url').value = '';
    document.getElementById('icon').value = '';
    document.getElementById('image').value = '';
    document.getElementById('is_visible').value = '1'; 
    document.getElementById('sorting').value = '0';
    document.getElementById('parent').value = ''; 

    // Update modal title
    document.getElementById('menuItemModalLabel').innerText = 'Add Menu Item';
});


function openEditModal(menuItem) {
 console.log(menuItem); 
    document.getElementById('menuItemForm').action = `/menus/${menuItem.slug}`;

    
    document.getElementById('menuItemId').value = menuItem.id;
    document.getElementById('name').value = menuItem.name;
    document.getElementById('url').value = menuItem.url;
    document.getElementById('icon').value = menuItem.icon;
    document.getElementById('image').value = menuItem.image;
    document.getElementById('is_visible').value = menuItem.is_visible;
    document.getElementById('sorting').value = menuItem.sort;
  document.getElementById('parent').value = menuItem.parent || ''; 


    document.getElementById('menuItemModalLabel').innerText = 'Edit Menu Item';
    var modal = new bootstrap.Modal(document.getElementById('menuItemModal'));
    modal.show();
}

</script>

@endsection
