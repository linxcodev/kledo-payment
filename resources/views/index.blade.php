<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Kledo Payment</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand font-weght-bold" href="#">Kledo Payment</a>
      </nav>

      <div class="container mt-5">
        <h3>Table Payment</h3>
        <form class="form-inline" action="{{route('storePayment')}}" method="post">
          @csrf
          <input type="text" name="payment_name" value="" class="form-control mr-2" placeholder="Nama Payment...">
          <button type="submit" name="button" class="btn btn-primary my-2">Tambah</button>
        </form>
        @if ($errors->has('payment_name'))
          <span class="text-danger">{{ $errors->first('payment_name') }}</span><br><br>
        @endif

        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Payment</th>
              <th>Dibuat</th>
              <th>Diupdate</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($payments as $payment)
              <tr>
                <td>{{$loop->index+1}}</td>
                <td>{{$payment->payment_name}}</td>
                <td>{{$payment->created_at}}</td>
                <td>{{$payment->updated_at}}</td>
                <td> <input class="form-check-input" type="checkbox" data-entry="{{$payment->id}}"> </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        <div class="float-right">
          <button type="button" name="button" class="btn btn-danger" id="delete">Hapus</button>
        </div>

        {{ $payments->links() }}
      </div>

      <script src="{{asset('js/app.js')}}" charset="utf-8"></script>
      <script src="//js.pusher.com/3.1/pusher.min.js"></script>
      <script>
        // Enable pusher logging - don't include this in production
        // Pusher.logToConsole = true;

        const pusher = new Pusher('f2b1b2addfab4b4050a5', {
          cluster: 'ap1'
        });

        const channel = pusher.subscribe('payment-deleted');
        channel.bind('App\\Events\\PaymentDeleted', function(data) {
          alert(data.message);
          console.log(data.message);
        });
      </script>

      <script type="text/javascript">
        @if (session()->has('success'))
          alert(`{{ session()->get('success') }}`)
        @endif


        $("#delete").click(function () {
          let deleteID = [];
          $(".form-check-input:checked").each(function() {
              deleteID.push($(this).attr('data-entry'));
          });

          if (deleteID.length) {
            let check = confirm(`Apakah yakin ingin menghapus ${deleteID.length} payment?`);

            if (check) {
              let join_selected_values = deleteID.join(",");

              $.ajax({
                  url: '/delete',
                  type: 'POST',
                  headers: {'X-CSRF-TOKEN': $('input[name="_token"]').val()},
                  data: 'ids='+join_selected_values,
                  success: function (data) {
                    console.log('Berhasil menghapus data. load ulang untuk melihat perubahan');
                  },
                  error: function (data) {
                      alert(data.responseText);
                  }
              });
            }
          } else {
            alert('Mohon ceklis data terlebih dahulu.');
          }
        });
      </script>
    </body>
</html>
