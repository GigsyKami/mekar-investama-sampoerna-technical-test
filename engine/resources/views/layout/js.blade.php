<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        }
    });

    function showLoading() {
        $('#content').hide()
        $('#loading').addClass('d-flex').removeClass('d-none')
    }

    function hideLoading() {
        $('#content').show()
        $('#loading').addClass('d-none').removeClass('d-flex')
    }

    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function(toastEl) {
        return new bootstrap.Toast(toastEl)
    })

    var myToast = document.getElementById('toast')
    var toast = bootstrap.Toast.getInstance(myToast)

    function showToast(status, message) {
        $('.toast-header').find('strong').html(status)
        $('.toast-body').html(message)

        if (status == 'Success') {
            $('.toast-header').removeClass('bg-danger').addClass('bg-success')
        } else {
            $('.toast-header').removeClass('bg-success').addClass('bg-danger')
        }

        toast.show()
    }
</script>
<script>
    $(document).ready(function() {
        $('#history').click()
    })

    // view history
    $(document).on('click', '#history', function() {
        showLoading()
        $.ajax({
            url: `{{ route('history.index') }}`,
            method: 'get',
            success: function(res) {
                $('#content').empty().append(res.data)
            },
            error: function(res) {
                showToast('Error', res.responseJSON.message)
            },
            complete: function(res) {
                hideLoading()
            }
        })
    })

    // view Login
    $(document).on('click', '#login', function() {
        showLoading()
        $.ajax({
            url: `{{ route('login.index') }}`,
            method: 'get',
            success: function(res) {
                $('#content').empty().append(res.data)
            },
            error: function(res) {
                showToast('Error', res.responseJSON.message)
            },
            complete: function(res) {
                hideLoading()
            }
        })
    })

    // view Register
    $(document).on('click', '#register', function() {
        showLoading()
        $.ajax({
            url: `{{ route('register.index') }}`,
            method: 'get',
            success: function(res) {
                $('#content').empty().append(res.data)
            },
            error: function(res) {
                showToast('Error', res.responseJSON.message)
            },
            complete: function(res) {
                hideLoading()
            }
        })
    })

    // view Top up
    $(document).on('click', '#top-up', function() {
        showLoading()
        $.ajax({
            url: `{{ route('top-up.index') }}`,
            method: 'get',
            success: function(res) {
                $('#content').empty().append(res.data)
            },
            error: function(res) {
                showToast('Error', res.responseJSON.message)
            },
            complete: function(res) {
                hideLoading()
            }
        })
    })

    // view Transfer
    $(document).on('click', '#transfer', function() {
        showLoading()
        $.ajax({
            url: `{{ route('transfer.index') }}`,
            method: 'get',
            success: function(res) {
                $('#content').empty().append(res.data)
            },
            error: function(res) {
                showToast('Error', res.responseJSON.message)
            },
            complete: function(res) {
                hideLoading()
            }
        })
    })
</script>

<script>
    // Submit Topup
    $(document).on('click', '#submit-topup', function(e) {
        e.stopPropagation()
        var url = $(this).parents('form').attr('action')
        var amount = $('#amount').val()
        showLoading()
        console.log('submit')
        $.ajax({
            url: url,
            method: 'post',
            data: {
                amount: amount
            },
            success: function(res) {
                showToast('Success', res.message)
            },
            error: function(res) {
                $.each(res.responseJSON.data, function(i, val){
                    console.log(i)
                    console.log(val)
                    showToast('Error', val.text)
                })

                // showToast('Error', res.responseJSON.message)
            },
            complete: function(res) {
                hideLoading()
            }
        })
    })

    // Submit Tansfer
    $(document).on('click', '#submit-transfer', function(e) {
        e.stopPropagation()
        var url = $(this).parents('form').attr('action')
        var amount = $('#amount').val()
        var to_user_id = $('#to_user_id').val()
        showLoading()
        $.ajax({
            url: url,
            method: 'post',
            data: {
                amount: amount,
                to_user_id: to_user_id
            },
            success: function(res) {
                showToast('Success', res.message)
            },
            error: function(res) {
                showToast('Error', res.responseJSON.message)
            },
            complete: function(res) {
                hideLoading()
            }
        })
    })

    // Submit Login
    $(document).on('click', '#submit-login', function(e) {
        e.stopPropagation()
        var url = $(this).parents('form').attr('action')
        var email = $('#email').val()
        var password = $('#password').val()

        showLoading()
        $.ajax({
            url: url,
            method: 'post',
            data: {
                email: email,
                password: password,
            },
            success: function(res) {
                location.reload()
            },
            error: function(res) {
                showToast('Error', res.responseJSON.message)
            },
            complete: function() {
                hideLoading()
            }
        })
    })

    // Submit register
    $(document).on('click', '#submit-register', function(e) {
        e.stopPropagation()
        var url = $(this).parents('form').attr('action')
        var name = $('#name').val()
        var email = $('#email').val()
        var password = $('#password').val()

        showLoading()
        $.ajax({
            url: url,
            method: 'post',
            data: {
                name: name,
                email: email,
                password: password,
            },
            success: function(res) {
                location.reload()
            },
            error: function(res) {
                showToast('Error', res.responseJSON.message)
            },
            complete: function() {
                hideLoading()
            }
        })
    })

    // Submit Logout
    $(document).on('click', '#logout', function(e) {
        e.stopPropagation()
        showLoading()
        $.ajax({
            url: `{{ route('logout') }}`,
            method: 'post',
            success: function(res) {},
            error: function(res) {
                showToast('Error', res.responseJSON.message)
            },
            complete: function(res) {
                location.reload()
                hideLoading()
            }
        })
    })
</script>
@stack('js')
