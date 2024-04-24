<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker3.standalone.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js">
  </script>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-md-7 co-12">
        <div class="card card-4">
          <div class="teel-head">
            Electricity Bill Calculator<sup><small style="font-size: 10px"></small></sup>
          </div>
          <div class="card-body">
            <ul class="nav nav-tabs nav-justified">
              <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#simple">Generic</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="">Advanced</a>
              </li>
            </ul>
            <br>
            <div class="tab-content">
              <div class="tab-pane container active" id="simple">
                <form method="post" action="postTariff.php" class="formTariff">
                  <div class="form-group row">
                    <label class="control-label col-sm-3">Tariff</label>
                    <div class="col-sm-9">
                      <select class="form-control" name="tariff_id" id="tariff">
                        <option value="1" data-load-flag="0">LT-1A</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-sm-3">Purpose</label>
                    <div class="col-sm-9">
                      <select name="purpose_id" id="purpose" class="form-control">
                        <option value="domestic" data-load-flag="0">Domestic</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-sm-3">Billing Cycle</label>
                    <div class="col-sm-9">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="frequency" value="2" checked id="frequency2">
                        <label class="form-check-label" for="phase_1"> 2 months</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-sm-3">Consumed Units</label>
                    <div class="col-sm-9">
                      <input type="text" name="WNL" id="unit" required autocomplete="off" class="form-control num-5">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-sm-3">Phase</label>
                    <div class="col-sm-9">
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="phase" value="1" checked id="phase1">
                        <label class="form-check-label" for="phase1"> Single phase</label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group row" id="load-form-group" style="display: none">
                    <label class="control-label col-sm-3">Connected Load</label>
                    <div class="col-sm-9">
                      <input type="text" name="load" id="load" autocomplete="off" class="form-control num-5" required
                        placeholder="watt">
                    </div>
                  </div>
                  <div class="form-group row">
                    <div class="col-sm-offset-5 col-sm-1">
                      <button type="submit" id="calculateButton" class="btn btn-fill btn-teel center submitTariff"
                        style="margin-bottom:15px">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-5" style="display:none" id="resultDiv">
        <div class="alert alert-danger" style="top: 50%;display: none" wfd-invisible="true"></div>

        <div class="card card-4" style="" id="bill" wfd-invisible="true">
          <div class="card-body no-padding" style="padding:0!important">
            <table class="table" id="bill-details">
              <tr>
                <th class="blue-head">Bill Details</th>
                <th class="blue-head" style="width: 40px;text-align:right!important">Amount(₹)</th>
              </tr>

              <tr>

              </tr>

              <tr>
                <th class="desc blue-tail">Total Amount<br></th>
                <th style="text-align:right!important" class="total blue-tail"></th>
              </tr>
            </table>
          </div>
        </div>

      </div>
    </div>
  </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
   $(document).ready(function() {
  $('#calculateButton').click(function(event) {
    event.preventDefault(); // Prevent the default form submission

    var units = $('#unit').val();

    // Get the CSRF token from the meta tag
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
      url: '{{ route('calculateElectricityBill') }}',
      method: 'POST',
      // Set the CSRF token in the headers
      headers: {
        'X-CSRF-TOKEN': csrfToken
      },
      data: { units: units },
      success: function(response) {
        if (response.success) {
          $('.total.blue-tail').text('₹' + response.bill_amount); // Populate the element with the bill amount
  
          // Show the result container only after successful population
          $('#resultDiv').show(); 
        } 
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
        $('#resultDiv').hide(); // Hide the result container in case of an error
      }
    });
  });
});

  </script>
</body>

</html>