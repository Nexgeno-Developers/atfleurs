<div class="row no-gutters pb-md-0 pb-2 product_avaiblity">
    <div class="col-12" id="pincode-checker">
        <div class="col-sm-12 ml-0 pl-0 pb-1 pt-3">
            <div class="opacity-90">{{ translate('Check Product Availability') }}:</div>
        </div>
        <form id="pincode-form" method="POST">
            @csrf
            <input type="hidden" id="product_id" name="product_id" value="{{ $detailedProduct->id }}">
            <div class="form-group d-flex align-items-center mb-2">
                <input type="text" id="pincode" name="pincode" class="form-control me-2" placeholder="Enter Pincode"
                    maxlength="6" value="{{ session('pincode', '') }}" {{ session('pincode') ? 'readonly' : '' }}>
                <button type="button" id="check-pincode-btn" class="d-none btn btn-primary" {{ session('pincode') ? 'disabled' : '' }}>
                    Check
                </button>
                @if (session('pincode'))
                    <button type="button" id="edit-pincode-btn" class="btn btn-link ms-2">
                        <i class="fa fa-edit"></i>
                    </button>
                @endif
            </div>
            <div id="pincode-result" class="mt-0">
                {{-- @if (session('pincode_result'))
                    <span class="{{ session('pincode_result')['status'] }}">
                        {{ session('pincode_result')['message'] }}
                    </span>
                @endif --}}
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

    .product_avaiblity input#pincode {
        border-radius: 24px;
        padding-left: 15px;
        width: 300px;
        /* border-right: 0; */
        color: #000000ab;
        border-color: #000000ab;
    }

    .product_avaiblity input#pincode.error:not(:focus) {
        color: black;
        border: 2px solid red; /* Red border for error */
        box-shadow: 0 0 5px rgba(255, 0, 0, 0.6); /* Optional shadow for emphasis */
    }

    .product_avaiblity button#check-pincode-btn {
        border-radius: 0px 50px 50px 0px;
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
