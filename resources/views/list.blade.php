@extends('layouts.app')
@section('title', '| List')
@section('content')
        <div class="container">
            <div class="row justify-content-center">
                @foreach($contacts as $contact)
                <div class="col-md-4">
                    <div class="card" style="width: 18rem; margin-bottom: 20px;">
                        <div class="card-header">
                            <strong>{{ $contact->firstname }} {{ $contact->lastname }}</strong>
                            <input type="hidden" name="{{ $contact->id }}">
                            @if(Auth::user()->role == 1)
                                <button type="button" class="deleteContact" style="width: 20%; float: right;">X</button>
                            @endif
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach($numbers as $number)
                                @if($contact->id === $number->contact_id)
                                        <li class="list-group-item"><p><strong>{{ ucfirst($number->type) }}:</strong> {{ $number->number }}</p>
                                            <div>
                                                <input type="hidden" name="{{ $number->id }}">
                                                @if(Auth::user()->role == 1)
                                                    <button type="button" class="deleteNumber" style="width: 30%; float: right; margin-left:10px;">Delete</button>
                                                    <button type="button" class="editNumber" style="width: 20%; float: right; margin-left:10px;">Edit</button>
                                                @endif
                                            </div>
                                        </li>
                                @endif
                            @endforeach
                        </ul>
                        @if(Auth::user()->role == 1)
                            <button type="button" class="insertNumber" style="width: 100%; float: none;">Add new number</button>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
            <div id="insertModal">
                <div class="modal-guts">
                    <select id="phone_type">
                        <option value="mobile">Mobile</option>
                        <option value="home">Home</option>
                    </select>
                    <input type="text" id="insertNumber" placeholder="Enter number">
                    <button type="button" id="closeInsertModal">X</button>
                    <br>
                    <input type="hidden" id="getContactId">
                    <br>
                    <button type="button" id="addNumber">Add Number</button>
                </div>
            </div>
            <div id="editModal">
                <div class="modal-guts-edit">
                    <select id="phone_type_edit">
                        <option value="mobile">Mobile</option>
                        <option value="home">Home</option>
                    </select>
                    <input type="text" id="editNumber" placeholder="Enter number">
                    <button type="button" id="closeEditModal">X</button>
                    <br>
                    <input type="hidden" id="getContactEditId">
                    <br>
                    <input type="hidden" id="idNumber">
                    <button type="button" id="EditNumber">Edit Number</button>
                </div>
            </div>
@endsection
@section('script')
    <script>
        (function($){
            $(document).ready(function() {
                $(".deleteContact").click(function(e){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    e.preventDefault();
                    var contactId = $(this).siblings('input').attr('name');
                    var listNumber = [];
                    $(this).parent().siblings('ul').children().each(function(){
                        var numbersId = $(this).children().children('input').attr('name');
                        listNumber.push(numbersId);
                    })
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: "{{ route('deleteContact') }}",
                        data: { 'id': contactId, 'listNumber': listNumber },
                        success: function (response) {
                            location.reload();
                        }
                    });
                })
                $(".deleteNumber").click(function(e){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    e.preventDefault();
                    var numberId = $(this).siblings('input').attr('name');
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: "{{ route('deleteNumber') }}",
                        data: { 'id': numberId },
                        success: function (response) {
                            location.reload();
                        }
                    });
                })
                $(".insertNumber").click(function(){
                    var contact_id = $(this).siblings(".card-header").children('input').attr('name');
                    $('#getContactId').val(contact_id);
                    $('#insertModal').css('display', 'block');
                })
                $("#closeInsertModal").click(function() {
                    $('#insertModal').css('display', 'none');
                });
                $("#addNumber").click(function(e){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    e.preventDefault();
                    var contact_id = $('#getContactId').attr('value');
                    var number = document.getElementById('insertNumber').value;
                    var type = $( "#phone_type" ).val();
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: "{{ route('insertNumber') }}",
                        data: { 'id': contact_id, 'number': number, 'type': type },
                        success: function (response) {
                            console.log("it Work");
                            location.reload();
                        }
                    });
                })
                $(".editNumber").click(function(){
                    var number_id = $(this).siblings("input").attr('name');
                    var typeAndMobile = $(this).parent().siblings('p').text();
                    var res = typeAndMobile.split(':');
                    var type = res[0].toLowerCase();
                    var number = res[1].trim();
                    $("#phone_type_edit").val(type);
                    $("#editNumber").val(number);
                    $('#editModal').css('display', 'block');
                    $('#idNumber').val(number_id);
                })
                $("#closeEditModal").click(function() {
                    $('#editModal').css('display', 'none');
                });
                $('#EditNumber').click(function(e){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    e.preventDefault();
                    var number_id = $('#idNumber').val();
                    var number = $('#editNumber').val();
                    var type = $('#phone_type_edit').val();
                    console.log(number_id);
                    console.log(number);
                    console.log(type);
                    $.ajax({
                        type: 'POST',
                        dataType: "JSON",
                        url: "{{ route('updateNumber') }}",
                        data: { 'id': number_id, 'number': number, 'type': type },
                        success: function (response) {
                            location.reload();
                        }
                    });
                })
            });
        })(jQuery);
    </script>
@endsection
