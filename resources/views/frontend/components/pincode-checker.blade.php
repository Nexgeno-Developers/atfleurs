<div class="row no-gutters pb-md-3 pb-2">
    <div class="col-12" id="pincode-checker">
        <div class="col-sm-12">
            <div class="opacity-90 my-2">{{ translate('Check Product Availability') }}:</div>
        </div>
        <form id="pincode-form" method="POST">
            @csrf
            <input type="hidden" id="product_id" name="product_id" value="{{ $detailedProduct->id }}">
            <div class="form-group d-flex align-items-center">
                <input type="text" id="pincode" name="pincode" class="form-control me-2" placeholder="Enter Pincode"
                    maxlength="6" value="{{ session('pincode', '') }}" {{ session('pincode') ? 'readonly' : '' }}>
                <button type="button" id="check-pincode-btn" class="btn btn-primary" {{ session('pincode') ? 'disabled' : '' }}>
                    {{ session('pincode') ? 'Recheck' : 'Check' }}
                </button>
                @if (session('pincode'))
                    <button type="button" id="edit-pincode-btn" class="btn btn-link ms-2">
                        <i class="fa fa-edit"></i>
                    </button>
                @endif
            </div>
            <div id="pincode-result" class="mt-3">
                @if (session('pincode_result'))
                    <span class="{{ session('pincode_result')['status'] }}">
                        {{ session('pincode_result')['message'] }}
                    </span>
                @endif
            </div>
        </form>
    </div>
</div>

<style>
    #pincode-checker {
        max-width: 400px;
        /*margin: 20px auto;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        text-align: center;*/
    }

    .form-group input {
        width: 100%;
        padding: 8px;
        border-radius: 4px;
        border: 1px solid #ccc;
    }

    #pincode-result {
        font-size: 14px;
    }

    #pincode-result.success {
        color: green;
    }

    #pincode-result.error {
        color: red;
    }
</style>
