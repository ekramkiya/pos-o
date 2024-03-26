@extends('layouts.admin')

@section('content')
    <style>
        * {
            font-size: 18px;
            font-family: 'Times New Roman';
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

        td.description,
        th.description {
            width: 75px;
            max-width: 75px;
        }

        td.quantity,
        th.quantity {
            width: 50px;
            max-width: 50px;
            word-break: break-all;
        }

        td.price,
        th.price {
            width: 50px;
            max-width: 50px;
            word-break: break-all;
        }

        .centered {
            text-align: center;
            align-content: center;
        }

        .ticket {
            width: 220px;
            max-width: 220px;

        }

        img {
            width: 50px;
            height: 50px;
        }

        @media print {
            .hidden-print,
            .hidden-pos,
            .hidden-print * {
                /* display: none !important; */
            }
        }
    </style>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Print BarCode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ticket text-center">
                        @for ($i = 0; $i < $product->quantity; $i++)
                            <tr>
                                <td>
                                    {!! DNS1D::getBarcodeSVG($product->barcode, "PHARMA", ) !!}
                                   {{-- <p> P - {{ $product->barcode }}</p> --}}
                                   <p></p>
                                </td>
                            </tr>
                        @endfor
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="{{ route('products.index') }}" class="btn btn-primary">
                        <i class="fas fa-arrow-left"></i>
                    </a>
                    <button id="printButton" type="button" class="btn btn-warning">
                        <i class="fas fa-print"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Wait for the page to load
        document.addEventListener("DOMContentLoaded", function(event) {
            // Show the modal
            $('#exampleModalCenter').modal('show');

            // Handle the print button click event
            document.getElementById("printButton").addEventListener("click", function() {
                // Get the modal body element
                var modalBody = document.querySelector("#exampleModalCenter .modal-body");

                // Clone the modal body content
                var printContents = modalBody.cloneNode(true);

                // Create a new window to print the contents
                var printWindow = window.open('', '_blank');

                printWindow.document.body.appendChild(printContents);
                printWindow.print();

                // Close the new window
                printWindow.close();
            });
        });
    </script>
@endsection