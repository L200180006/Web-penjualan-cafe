<div class="container-fluid">


    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <form class="user" method="POST" action="<?= base_url('admin/add_menu'); ?>">

        <div class="col-lg-9 mx-auto">
            <div class="p-5">
                <div class="form-group">
                    <label>Menu</label>
                    <input type="text" class="form-control" id="nama_menu" name="nama_menu" placeholder="Menu" value="<?= set_value('nama_menu'); ?>">
                    <?= form_error('nama_menu', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
                <div class="form-group">
                    <label>Price</label>
                    <input type="text" class="form-control number-cleave" id="harga_menu" name="harga_menu" placeholder="Rp." value="<?= set_value('harga_menu'); ?>">
                    <?= form_error('harga_menu', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-primary">
                    Add Menu
                </button>
    </form>

</div>
</div>
</div>
</div>





</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.0.2/cleave.min.js" integrity="sha512-SvgzybymTn9KvnNGu0HxXiGoNeOi0TTK7viiG0EGn2Qbeu/NFi3JdWrJs2JHiGA1Lph+dxiDv5F9gDlcgBzjfA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    var row = 0;
    var edit = 0;

    $('.number-cleave').toArray().forEach(function(field) {
        new Cleave(field, {
            numeral: true,
            numeralThousandsGroupStyle: 'thousand',
            numeralDecimalMark: ',',
            delimiter: '.'
        });
    });

    function number_with_dot(x) {
        var parts = x.toString().split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        return parts.join('.');
    }

    function remove_dot(text) {
        text = text ?? '';
        return text.toString().replace(/\./g, '');
    }

    $('#harga_menu').on('keyup change', function() {
        var harga_menu = remove_dot($(this).val());
        harga_menu = $.isNumeric(harga_menu) ? parseInt(harga_menu) : 0;

        $('#harga_menu').val(number_with_dot(harga_menu));
    });
</script>