<?php
    function formatCPF($document_number)
    {
        return Str::substr($document_number, 0, 3) . '.' . Str::substr($document_number, 3, 3) . '.' . Str::substr($document_number, 6, 3) . '-' . Str::substr($document_number, 9);
    }

    function formatCNPJ($document_number)
    {
        return Str::substr($document_number, 0, 2) . '.' . Str::substr($document_number, 2, 3) . '.' . Str::substr($document_number, 5, 3) . '/' . Str::substr($document_number, 8, 4) . '-' . Str::substr($document_number, 12, 2);
    }