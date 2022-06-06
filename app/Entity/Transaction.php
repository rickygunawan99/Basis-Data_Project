<?php


namespace PHP\MVC\Entity;


class Transaction
{
    public ?int $idTransaksi;
    public string $email;
    public int $idProduct;
    public int $totalHarga;
    public ?int $statusPemesanan;
    public ?string $date;
    public ?string $kodeVoucher;
}