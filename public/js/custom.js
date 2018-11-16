$(document).ready(function () {
    $(".alert.fixed").fadeTo(4000, 500).slideUp(500, function () {
        $(".alert.fixed").alert('close');
    });

    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });

    if ($('[id^="status_"]').length > 0)
    {
        $('[id^="status_"]').click(function () {
            var id = $(this).attr('id').split('_')[1];
            $.ajax({
                url: baseUrl + '/ajax/customer_status',
                type: 'post',
                dataType: 'json',
                data: {id: id},
                success: function (msg)
                {
                    if ($('#status_' + id).html() == '<span class="btn btn-info"><i class="fa fa-check"></i> Active</span>')
                        $('#status_' + id).html('<span class="btn btn-warning"><i class="fa fa-times"></i> InActive</span>')
                    else
                        $('#status_' + id).html('<span class="btn btn-info"><i class="fa fa-check"></i> Active</span>');
                }
            });
        });
    }
    if ($('[id^="editcustomer_"]').length > 0)
    {
        $('[id^="editcustomer_"]').click(function () {
            var id = $(this).attr('id').split('_')[1];
            $.ajax({
                url: baseUrl + '/ajax/getCustomer',
                type: 'post',
                dataType: 'json',
                data: {id: id},
                success: function (msg)
                {
                    $.each(msg, function (key, response)
                    {
                        $('#edit #customer_id_name').val(response["CustIDName"]);
                        $('#edit #customer_name').val(response["CustName"]);
                        $('#edit #cid').val(response["CustID"]);
                    });
                    $('#edit').modal('show');
                }
            });
        });
    }
    if ($('[id^="delCustomer_"]').length > 0)
    {
        $('[id^="delCustomer_"]').click(function () {
            var id = $(this).attr('id').split('_')[1];
            $('#delete #cid').val(id);
            $('#delete').modal('show');
        });
    }

    if ($('[id^="assets_"]').length > 0)
    {
        $('[id^="assets_"]').click(function () {
            var id = $(this).attr('id').split('_')[1];
            $('#addAssets #cid').val(id);
            $('#addAssets').modal('show');
        });
    }
    if ($('[id^="contact_"]').length > 0)
    {
        $('[id^="contact_"]').click(function () {
            var id = $(this).attr('id').split('_')[1];
            $('#addContact #customer_id').val(id);
            $('#addContact').modal('show');
        });
    }

    if ($('[id^="editAssets_"]').length > 0)
    {
        $('[id^="editAssets_"]').click(function () {
            var id = $(this).attr('id').split('_')[1];
            $.ajax({
                url: baseUrl + '/ajax/getAssets',
                type: 'post',
                dataType: 'json',
                data: {id: id},
                success: function (msg)
                {
                    $.each(msg, function (key, response)
                    {
                        $('#editAssets #asset_name').val(response["AssetName"]);
                        $('#editAssets #asset_url').val(response["AssetURL"]);
                        $('#editAssets #asset_user_name').val(response["AssetUsername"]);
                        $('#editAssets #asset_password').val(response["AssetPassword"]);
                        $('#editAssets #asset_start_date').val(response["AssetStartDate"]);
                        $('#editAssets #asset_expiry_date').val(response["AssetExpiryDate"]);
                        $('#editAssets #asset_amount').val(response["AssetAmount"]);
                        $('#editAssets #asset_renewal_amount').val(response["AssetRenewalAmount"]);
                        $('#editAssets #notes').val(response["Notes"]);
                        $('#editAssets #aid').val(id);
                    });
                    $('#editAssets').modal('show');
                }
            });
        });
    }
    if ($('[id^="editContact_"]').length > 0)
    {
        $('[id^="editContact_"]').click(function () {
            var id = $(this).attr('id').split('_')[1];
            $.ajax({
                url: baseUrl + '/ajax/getContact',
                type: 'post',
                dataType: 'json',
                data: {id: id},
                success: function (msg)
                {
                    $.each(msg, function (key, response)
                    {
                        $('#editContact #customer_contact_name').val(response["ContactName"]);
                        $('#editContact #customer_contact_email').val(response["ContactEmail"]);
                        $('#editContact #address1').val(response["ContactAddress1"]);
                        $('#editContact #address2').val(response["ContactAddress2"]);
                        $('#editContact #city').val(response["ContactCity"]);
                        $('#editContact #country').val(response["ContactCountry"]);
                        $('#editContact #phone').val(response["ContactPhone"]);
                        $('#editContact #fax').val(response["ContactFax"]);
                        $('#editContact #mobile1').val(response["ContactMobile1"]);
                        $('#editContact #mobile2').val(response["ContactMobile2"]);
                        $('#editContact #ccid').val(id);
                    });
                    $('#editContact').modal('show');
                }
            });
        });
    }
    if ($('[id^="delAssets_"]').length > 0)
    {
        $('[id^="delAssets_"]').click(function () {
            var id = $(this).attr('id').split('_')[1];
            $('#deleteAssets #assets_id').val(id);
            $('#deleteAssets').modal('show');
        });
    }
    if ($('[id^="delContact_"]').length > 0)
    {
        $('[id^="delContact_"]').click(function () {
            var id = $(this).attr('id').split('_')[1];
            $('#deleteContact #contactID').val(id);
            $('#deleteContact').modal('show');
        });
    }

//document.ready close
});