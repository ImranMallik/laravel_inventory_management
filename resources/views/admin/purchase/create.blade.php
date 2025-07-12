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
            const productSearchInput = $("#product_search");
            const warehouseDropdown = $("#warehouse_id");
            const productList = $("#product_list");
            const warehouseError = $("#warehouse_error");
            const orderItemsTableBody = $("#orderItemsTable tbody");
            const productSearchUrl =
                "{{ route('admin.purchase-products.search') }}"; // You must define this route server-side

            // Product Search
            productSearchInput.on("keyup", function() {
                const query = $(this).val();
                const warehouseId = warehouseDropdown.val();

                if (!warehouseId) {
                    warehouseError.removeClass('d-none');
                    productList.html("");
                    return;
                } else {
                    warehouseError.addClass('d-none');
                }

                if (query.length > 1) {
                    fetchProducts(query, warehouseId);
                } else {
                    productList.html("");
                }
            });

            function fetchProducts(query, warehouseId) {
                $.get(productSearchUrl, {
                    query: query,
                    warehouse_id: warehouseId
                }, function(data) {
                    productList.html("");

                    if (data.length > 0) {
                        $.each(data, function(index, product) {
                            const item = `
                        <a href="#" class="list-group-item list-group-item-action product-item"
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

                        $(".product-item").on("click", function(e) {
                            e.preventDefault();
                            addProductToTable($(this));
                        });

                    } else {
                        productList.html('<p class="text-muted">No Product Found</p>');
                    }
                });
            }

            function addProductToTable($product) {
                const productId = $product.data("id");
                const productCode = $product.data("code");
                const productName = $product.data("name");
                const netUnitCost = parseFloat($product.data("cost"));
                const stock = parseInt($product.data("stock"));

                if ($(`tr[data-id="${productId}"]`).length > 0) {
                    alert("Product already added.");
                    return;
                }

                const row = `
        <tr data-id="${productId}">
            <td>
                ${productCode} - ${productName}
                <button type="button" class="btn btn-primary btn-sm edit-discount-btn"
                    data-id="${productId}" 
                    data-name="${productName}" 
                    data-cost="${netUnitCost}">
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
            <td><button class="btn btn-danger btn-sm remove-product"><span class="mdi mdi-delete-circle mdi-18px"></span></button></td>
        </tr>`;

                orderItemsTableBody.append(row);
                productList.html("");
                productSearchInput.val("");

                updateEvents();
                updateGrandTotal();
            }

            function updateEvents() {
                $(".qty-input, .discount-input").off("input").on("input", function() {
                    const row = $(this).closest("tr");
                    const qty = parseFloat(row.find(".qty-input").val()) || 1;
                    const unitCost = parseFloat(row.find(".qty-input").data("cost")) || 0;
                    const discount = parseFloat(row.find(".discount-input").val()) || 0;
                    const subtotal = (unitCost * qty) - discount;

                    row.find(".subtotal").text(subtotal.toFixed(2));
                    updateGrandTotal();
                });

                $(".increment-qty").off("click").on("click", function() {
                    const input = $(this).siblings(".qty-input");
                    const max = parseInt(input.attr("max"));
                    let value = parseInt(input.val());
                    if (value < max) {
                        input.val(value + 1);
                        updateSubtotal($(this).closest("tr"));
                    }
                });

                $(".decrement-qty").off("click").on("click", function() {
                    const input = $(this).siblings(".qty-input");
                    const min = parseInt(input.attr("min"));
                    let value = parseInt(input.val());
                    if (value > min) {
                        input.val(value - 1);
                        updateSubtotal($(this).closest("tr"));
                    }
                });

                $(".remove-product").off("click").on("click", function() {
                    $(this).closest("tr").remove();
                    updateGrandTotal();
                });
            }

            function updateSubtotal($row) {
                const qty = parseFloat($row.find(".qty-input").val()) || 1;
                const discount = parseFloat($row.find(".discount-input").val()) || 0;
                const unitCost = parseFloat($row.find(".qty-input").data("cost")) || 0;

                const subtotal = (unitCost * qty) - discount;
                $row.find(".subtotal").text(subtotal.toFixed(2));

                updateGrandTotal();
            }

            function updateGrandTotal() {
                let grandTotal = 0;

                $(".subtotal").each(function() {
                    grandTotal += parseFloat($(this).text()) || 0;
                });

                const discount = parseFloat($("#inputDiscount").val()) || 0;
                const shipping = parseFloat($("#inputShipping").val()) || 0;

                grandTotal = grandTotal - discount + shipping;
                if (grandTotal < 0) grandTotal = 0;

                $("#grandTotal").text(`₹ ${grandTotal.toFixed(2)}`);
                $("input[name='grand_total']").val(grandTotal.toFixed(2));
            }

            // Bind grand total on discount/shipping input
            $("#inputDiscount, #inputShipping").on("input", function() {
                updateGrandTotal();
            });

            //Model Code//=====================>
            let $modal = $(`
        <div id="customModal" style="
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;">
            
            <div style="background: white; padding: 20px; border-radius: 5px; width: 400px;">
                <h3 id="modalTitle"></h3>

                <label>Product Price: <span class="text-danger">*</span></label>
                <input type="text" id="modalPrice" class="form-control" />

                <label>Discount Type: <span class="text-danger">*</span></label>
                <select id="modalDiscountType" class="form-control">
                    <option value="">Select Discount</option>
                    <option value="fixed">Fixed</option>
                    <option value="percentage">Percentage</option>
                </select>

                <label>Discount: <span class="text-danger">*</span></label>
                <input type="text" id="modalDiscount" class="form-control" value="0.00" />

                <div style="margin-top: 15px; text-align: right;">
                    <button id="closeModal" class="btn btn-secondary">Close</button>
                    <button id="saveChanges" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    `);

            $("body").append($modal);

            // Show modal function
            function showModal(productName, productPrice, productId) {
                $("#modalTitle").text(productName);
                $("#modalPrice").val("₹ " + productPrice);
                $("#customModal").data("id", productId).css("display", "flex");
            }

            // Open modal on button click
            $(document).on("click", ".edit-discount-btn", function(e) {
                e.preventDefault();
                const $btn = $(this);
                const productId = $btn.data("id");
                const productName = $btn.data("name");
                const productPrice = $btn.data("cost");

                showModal(productName, productPrice, productId);
            });

            // Close modal
            $(document).on("click", "#closeModal", function() {
                $("#customModal").hide();
            });

            // Optional: Save changes click handler
            $("#saveChanges").on("click", function() {
                const discountType = $("#modalDiscountType").val();
                const discountValue = $("#modalDiscount").val();
                const productId = $("#customModal").data("id");

                // Do something with the discount values...
                console.log("Saving discount for product:", productId, discountType, discountValue);

                $("#customModal").hide();
            });

            // Save model Data=============================>
            // Save changes event
            $(document).on("click", "#saveChanges", function() {
                let updatedPrice = parseFloat($("#modalPrice").val().replace("TK ", "")) || 0;
                let discountValue = parseFloat($("#modalDiscount").val()) || 0;
                let discountType = $("#modalDiscountType").val();
                let productId = $("#customModal").data("id");
                let $row = $(`tr[data-id="${productId}"]`);

                if ($row.length) {
                    let $priceCell = $row.find("td:nth-child(2)");
                    let $qtyInput = $row.find(".qty-input");
                    let $discountInput = $row.find(".discount-input");
                    let $subtotalCell = $row.find(".subtotal");

                    // Update price display
                    $priceCell.text(updatedPrice.toFixed(2));
                    $priceCell.append(
                        `<input type="hidden" name="products[${productId}][cost]" value="${updatedPrice}">`
                    );
                    $qtyInput.data("cost", updatedPrice);

                    // Update discount field
                    $discountInput.val(discountValue.toFixed(2));

                    // Recalculate subtotal
                    let qty = parseFloat($qtyInput.val()) || 1;
                    let discountAmount = discountType === "percentage" ?
                        (updatedPrice * qty * (discountValue / 100)) :
                        discountValue;

                    let subtotal = (updatedPrice * qty) - discountAmount;
                    if (subtotal < 0) subtotal = 0;

                    $subtotalCell.text(subtotal.toFixed(2));

                    $("#customModal").hide(); // Close modal
                    updateGrandTotal();
                }
            });

            // Update grand total when discount or shipping input changes
            $("#inputDiscount, #inputShipping").on("input", function() {
                updateGrandTotal();
            });

            // Update display fields for discount and shipping
            $("#inputDiscount").on("input", function() {
                $("#displayDiscount").text(this.value || 0);
            });
            $("#inputShipping").on("input", function() {
                $("#shippingDisplay").text(this.value || 0);
            });

        });
    </script>
@endpush
