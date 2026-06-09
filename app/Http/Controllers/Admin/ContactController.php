<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::all();
        return view('pages.admin.contact.index', compact('contacts'));
    }

    public function contactAdd()
    {
        return view('pages.admin.contact.add_contact');
    }

    public function saveContact(Request $request)
    {
        // $request->validate([
        //     'contact_country_name' => 'required|string|max:255',
        //     'contact_address' => 'required|string|max:255',
        //     'contact_tel_label' => 'required|string|max:255',
        //     'contact_tel_number' => 'required|string|max:255',
        //     'contact_email_label' => 'required|string|max:255',
        //     'contact_email_address' => 'required|email|max:255',
        //     'contact_email_url' => 'required|string|max:255',
        //     'contact_site_name' => 'required|string|max:255',
        //     'contact_site_url' => 'required|url|max:255',
        // ]);
    
        
        $contact = new Contact([
            'contact_country_name' => $request->input('contact_country_name'),
            'contact_address' => $request->input('contact_address'),
            'contact_tel_label' => $request->input('contact_tel_label'),
            'contact_tel_number' => $request->input('contact_tel_number'),
            'contact_email_label' => $request->input('contact_email_label'),
            'contact_email_address' => $request->input('contact_email_address'),
            'contact_email_url' => $request->input('contact_email_url'),
            'contact_site_name' => $request->input('contact_site_name'),
            'contact_site_url' => $request->input('contact_site_url'),
        ]);
    
        $contact->save();
    
       
        return redirect()->route('admin.Contacts')->with('success', 'Contact information added successfully');
    }


    public function contactEdit($id)
    {
        
        $contact = Contact::find($id);
        return view('pages.admin.contact.edit_contact', compact('contact'));
    }


    public function contactUpdate(Request $request, $id)
        {
            // Validate the incoming request data
            $validatedData = $request->validate([
                'contact_country_name' => 'nullable|string|max:255',
                'contact_address' => 'nullable|string|max:255',
                'contact_tel_label' => 'nullable|string|max:255',
                'contact_tel_number' => 'nullable|string|max:255',
                'contact_email_label' => 'nullable|string|max:255',
                'contact_email_address' => 'nullable|email|max:255',
                'contact_email_url' => 'nullable|string|max:255',
                'contact_site_name' => 'nullable|string|max:255',
                'contact_site_url' => 'nullable|url|max:255',
            ]);

        
            $contact = Contact::find($id);

            if (!$contact) {
                
            }

            $contact->update($validatedData);

            return redirect()->route('admin.Contacts')->with('success', 'Contact details updated successfully');
        }


    public function contactContentRemove($id)
    {
        
        $contact = Contact::find($id);
        if ($contact) {
            $contact->delete();
            
        } else {
            return redirect()->back()
            ->with(["message" => ["result" => "error","msg" => "contact Not Found."] ]);
        }

        
        return redirect()->route('admin.Contacts');
    }
}
