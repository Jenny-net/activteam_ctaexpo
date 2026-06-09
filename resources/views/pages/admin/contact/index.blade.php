
@extends('layouts.main.admin-dashboard')

@section('content')
<div class="admin-body-area">
    <!-- Booking Status Section Start -->
    <div class="booking-status-sec category-list-sec">
        <div class="category-list-hdn">
            <h2>Contact Management</h2>
            <h3 class="create-cat">
                <a href="{{ route('admin.Contacts.add') }}">Add new Contact details</a>
            </h3>
        </div>
        <div class="contactAddressRow">
            @foreach ($contacts as $contact)
                <div class="contactAddressClm">
                            <div class="icon-container-edit">
                        <a href="{{ route('admin.Contacts.edit', $contact->id) }}" title="Edit" class="edit-icon">
                            <i class="fa fa-edit listing"></i>
                        </a>
                            </div>
                        <!-- Add margin or padding here -->
                        <div class="icon-container-delete">
                        <a href="{{ route('admin.Contacts.remove', $contact->id) }}" title="Delete" onclick="return confirm('Are you sure to delete?');" class="delete-icon">
                            <i class="fa fa-trash chat"></i>
                        </a>
                        </div>
    
                    <h2>{{ $contact->contact_country_name }}</h2>
                    <div class="contactAddressBox">
                        <p>{{ $contact->contact_address }}</p>
                        <p><span>{{ $contact->contact_tel_label }}</span> {{ $contact->contact_tel_number }}</p>
                        <p><span>{{ $contact->contact_email_label }}</span> <a href="mailto:{{ $contact->contact_email_address }}">{{ $contact->contact_email_address }}</a></p>
                        <p><span></span> <a href="{{ $contact->contact_site_url }}">{{ $contact->contact_site_url }}</a></p>
                    </div>
                </div>
    
            @endforeach
            </div>
        </div>
    </div>

    
</div>
   
</div>
<style>
    /* CSS for the contactAddressRow and contactAddressClm */
.contactAddressRow {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.contactAddressClm {
    width: calc(33.33% - 20px); 
    margin-bottom: 20px;
    background-color: #f5f5f5; 
    padding: 20px;
    border: 1px solid #ddd; 
    position: relative; 
}

/* CSS for the edit and delete icons */
.contactAddressClm .edit-icon,
.contactAddressClm .delete-icon {
    position: absolute;
    top: 10px;
    right: 10px;
    font-size: 20px; 
    cursor: pointer;
}


.contactAddressRow {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
}

.contactAddressClm {
    width: calc(33.33% - 20px);
    margin-bottom: 20px;
    background-color: #fff; 
    padding: 20px;
    border: 1px solid #ddd;
    position: relative;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.2);
}

.icon-container + .icon-container {
    margin-left: 20px; 
}


.contactAddressClm .edit-icon {
    position: absolute;
    top: 10px;
    right: 50px;
    font-size: 20px;
    cursor: pointer;
}

.contactAddressClm .delete-icon {
    position: absolute;
    top: 10px;
    right: 20px;
    font-size: 20px;
    cursor: pointer;
}


    </style>
@stop
