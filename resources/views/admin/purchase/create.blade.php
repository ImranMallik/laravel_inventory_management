@extends('admin.layouts.master')
@section('content')
    <div class="content d-flex flex-column flex-column-fluid">
        <div class="d-flex flex-column-fluid">
            <div class="container-fluid my-4">
                <div class="d-md-flex align-items-center justify-content-between">
                    <h3 class="mb-0">Create Purchase</h3>
                    <div class="text-end my-2 mt-md-0"><a class="btn btn-outline-primary"
                            href="{{ route('admin.all-purchase') }}">Back</a></div>
                </div>


                <div class="card">
                    <div class="card-body">
                        <form action=" " method="post" enctype="multipart/form-data">
                            @csrf


                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">Date: <span class="text-danger">*</span></label>
                                                <input type="date" name="date" value="<?php echo date('Y-m-d'); ?>"
                                                    class="form-control">
                                                @error('date')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <div class="form-group w-100">
                                                    <label class="form-label" for="formBasic">Warehouse : <span
                                                            class="text-danger">*</span></label>
                                                    <select name="warehouse_id" id="warehouse_id"
                                                        class="form-control form-select">
                                                        <option value="">Select Warehouse</option>
                                                        @foreach ($warehouses as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <small id="warehouse_error" class="text-danger d-none">Please select the
                                                        first warehouse.</small>
                                                </div>
                                            </div>

                                            <div class="col-md-4 mb-3">
                                                <div class="form-group w-100">
                                                    <label class="form-label" for="formBasic">Supplier : <span
                                                            class="text-danger">*</span></label>
                                                    <select name="supplier_id" id="supplier_id"
                                                        class="form-control form-select">
                                                        <option value="">Select Supplier</option>
                                                        @foreach ($suppliers as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('supplier_id')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-label">Product:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">
                                                        <i class="fas fa-search"></i>
                                                    </span>
                                                    <input type="search" id="product_search" name="search"
                                                        class="form-control" placeholder="Search product by code or name">
                                                </div>
                                                <div id="product_list" class="list-group mt-2"></div>
                                            </div>
                                        </div>




                                        <div class="row">
                                            <div class="col-md-12">
                                                <label class="form-label">Order items: <span
                                                        class="text-danger">*</span></label>
                                                <table id="orderItemsTable"
                                                    class="table table-striped table-bordered dataTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Product</th>
                                                            <th>Net Unit Cost</th>
                                                            <th>Stock</th>
                                                            <th>Qty</th>
                                                            <th>Discount</th>
                                                            <th>Subtotal</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody></tbody>
                                                </table>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 ms-auto">
                                                <div class="card">
                                                    <div class="card-body pt-7 pb-2">
                                                        <div class="table-responsive">
                                                            <table class="table border">
                                                                <tbody>
                                                                    <tr>
                                                                        <td class="py-3">Discount</td>
                                                                        <td class="py-3" id="displayDiscount">₹ 0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="py-3">Shipping</td>
                                                                        <td class="py-3" id="shippingDisplay">₹ 0.00</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="py-3 text-primary">Grand Total</td>
                                                                        <td class="py-3 text-primary" id="grandTotal">₹
                                                                            0.00</td>
                                                                        <input type="hidden" name="grand_total">
                                                                    </tr>


                                                                    <tr class="d-none">
                                                                        <td class="py-3">Paid Amount</td>
                                                                        <td class="py-3" id="paidAmount">
                                                                            <input type="text" name="paid_amount"
                                                                                placeholder="Enter amount paid"
                                                                                class="form-control">
                                                                        </td>
                                                                    </tr>
                                                                    <!-- new add full paid functionality  -->
                                                                    <tr class="d-none">
                                                                        <td class="py-3">Full Paid</td>
                                                                        <td class="py-3" id="fullPaid">
                                                                            <input type="text" name="full_paid"
                                                                                id="fullPaidInput">
                                                                        </td>
                                                                    </tr>
                                                                    <tr class="d-none">
                                                                        <td class="py-3">Due Amount</td>
                                                                        <td class="py-3" id="dueAmount">₹ 0.00</td>
                                                                        <input type="hidden" name="due_amount">
                                                                    </tr>


                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row">
                                            <div class="col-md-4">
                                                <label class="form-label">Discount: </label>
                                                <input type="number" id="inputDiscount" name="discount"
                                                    class="form-control" value="0.00">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Shipping: </label>
                                                <input type="number" id="inputShipping" name="shipping"
                                                    class="form-control" value="0.00">
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group w-100">
                                                    <label class="form-label" for="formBasic">Status : <span
                                                            class="text-danger">*</span></label>
                                                    <select name="status" id="status"
                                                        class="form-control form-select">
                                                        <option value="">Select Status</option>
                                                        <option value="Received">Received</option>
                                                        <option value="Pending">Pending</option>
                                                        <option value="Ordered">Ordered</option>
                                                    </select>
                                                    @error('status')
                                                        <span class="text-danger">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-2">
                                            <label class="form-label">Notes: </label>
                                            <textarea class="form-control" name="note" rows="3" placeholder="Enter Notes"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <div class="d-flex mt-5 justify-content-end">
                                    <button class="btn btn-primary me-3" type="submit">Save</button>
                                    <a class="btn btn-secondary" href="{{ route('admin.all-purchase') }}">Cancel</a>
                                </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#warehouse_id,#supplier_id').select2({
                placeholder: "Select Warehouse",
                allowClear: true,
                width: '100%'
            });

            // Search Product
            let productSearchInput = $("#product_search");
            let warehouseDropdown = $("#warehouse_id");
            let productList = $("#product_list");
            let warehouseError = $("#warehouse_error");
            let orderItemsTableBody = $("#orderItemsTable tbody");


            const productSearchUrl = "{{ route('admin.purchase-products.search') }}";

            // Search Product
            productSearchInput.on("keyup", function() {
                let query = $(this).val();
                let warehouse_id = warehouseDropdown.val();

                if (!warehouse_id) {
                    warehouseError.removeClass('d-none');
                    productList.html("");
                    return;
                } else {
                    warehouseError.addClass('d-none');
                }

                if (query.length > 1) {
                    fetchProducts(query, warehouse_id);
                } else {
                    productList.html("");
                }
            });

            function fetchProducts(query, warehouse_id) {
                $.ajax({
                    url: productSearchUrl,
                    type: "GET",
                    data: {
                        query: query,
                        warehouse_id: warehouse_id
                    },
                    dataType: "json",
                    success: function(data) {
                        productList.html("");

                        if (data.length > 0) {
                            $.each(data, function(index, product) {
                                let item = `<a href="#" class="list-group-item list-group-item-action product-item"
                            data-id="${product.id}"
                            data-code="${product.code}"
                            data-name="${product.name}"
                            data-cost="${product.price}"
                            data-stock="${product.product_qty}">
                            <span class="mdi mdi-text-search"></span>
                            ${product.code} - ${product.name}
                        </a>`;
                                productList.append(item);
                            });

                            // Product item click handler
                            $(".product-item").on("click", function(e) {
                                e.preventDefault();
                                addProductToTable($(this));
                            });
                        } else {
                            productList.html('<p class="text-muted">No Product Found</p>');
                        }
                    }
                });
            }

            // Add Product to Order Table
            function addProductToTable($product) {
                let productId = $product.data("id");
                let productCode = $product.data("code");
                let productName = $product.data("name");
                let netUnitCost = parseFloat($product.data("cost"));
                let stock = parseInt($product.data("stock"));

                // Check if product already added
                if ($(`tr[data-id="${productId}"]`).length > 0) {
                    alert("Product already added.");
                    return;
                }

                let row = `
            <tr data-id="${productId}">
                <td>
                    ${productCode} - ${productName}
                    <button type="button" class="btn btn-primary btn-sm edit-discount-btn"
                        data-id="${productId}" 
                        data-name="${productName}" 
                        data-cost="${netUnitCost}"
                        data-bs-toggle="modal">
                        <span class="mdi mdi-book-edit"></span>
                    </button>
                    <input type="hidden" name="products[${productId}][id]" value="${productId}">
                    <input type="hidden" name="products[${productId}][name]" value="${productName}">
                    <input type="hidden" name="products[${productId}][code]" value="${productCode}">
                </td>
                <td>${netUnitCost.toFixed(2)}
                    <input type="hidden" name="products[${productId}][cost]" value="${netUnitCost}">
                </td>
                <td style="color:#ffc121">${stock}</td>
                <td>
                    <div class="input-group">
                        <button class="btn btn-outline-secondary decrement-qty" type="button">−</button>
                        <input type="text" class="form-control text-center qty-input"
                            name="products[${productId}][quantity]" value="1" min="1" max="${stock}"
                            data-cost="${netUnitCost}" style="width: 30px;">
                        <button class="btn btn-outline-secondary increment-qty" type="button">+</button>
                    </div>
                </td>
                <td>
                    <input type="number" class="form-control discount-input"
                        name="products[${productId}][discount]" value="0" min="0" style="width:100px">
                </td>
                <td class="subtotal">${netUnitCost.toFixed(2)}</td>
                <td>
                    <button class="btn btn-danger btn-sm remove-product">
                        <span class="mdi mdi-delete-circle mdi-18px"></span>
                    </button>
                </td>
            </tr>
        `;

                orderItemsTableBody.append(row);
                productList.html("");
                productSearchInput.val("");
            }


        });
    </script>
@endpush
