<?php

declare(strict_types=1);

namespace Baraja\FioPaymentAuthorizator;


use Nette\Utils\DateTime;

final class Transaction implements \Baraja\BankTransferAuthorizator\Transaction
{
	private int $id;

	private \DateTime $date;

	private float $price;

	private string $currency;

	private ?string $toAccount;

	private ?string $toAccountName;

	private ?int $toBankCode;

	private ?string $toBankName;

	private ?int $constantSymbol;

	private ?int $variableSymbol;

	private ?int $specificSymbol;

	private ?string $userNotice;

	private ?string $toMessage;

	private ?string $type;

	private ?string $sender;

	private ?string $message;

	private ?string $comment;

	private ?string $bic;

	private ?int $idTransaction;


	public function __construct(string $line, string $defaultCurrency = 'CZK')
	{
		$parser = explode(';', $line);

		$this->id = ((int) ($parser[0] ?? null)) ?: '---id-not-defined---';
		$this->date = DateTime::from($parser[1] ?? null);
		$this->price = ((float) str_replace(',', '.', $parser[2] ?? '0')) ?: 0;
		$this->currency = strtoupper(trim($parser[3] ?? '', '"')) ?: $defaultCurrency;
		$this->toAccount = trim($parser[4] ?? '', '"') ?: null;
		$this->toAccountName = trim($parser[5] ?? '', '"') ?: null;
		$this->toBankCode = ((int) ($parser[6] ?? null)) ?: null;
		$this->toBankName = trim($parser[7] ?? '', '"') ?: null;
		$this->constantSymbol = ((int) ($parser[8] ?? null)) ?: null;
		$this->variableSymbol = ((int) ($parser[9] ?? null)) ?: null;
		$this->specificSymbol = ((int) ($parser[10] ?? null)) ?: null;
		$this->userNotice = trim($parser[11] ?? '', '"') ?: null;
		$this->toMessage = trim($parser[12] ?? '', '"') ?: null;
		$this->type = trim($parser[13] ?? '', '"') ?: null;
		$this->sender = trim($parser[14] ?? '', '"') ?: null;
		$this->message = trim($parser[15] ?? '', '"') ?: null;
		$this->comment = trim($parser[16] ?? '', '"') ?: null;
		$this->bic = trim($parser[17] ?? '', '"') ?: null;
		$this->idTransaction = ((int) ($parser[18] ?? null)) ?: null;
	}


	public function isVariableSymbol(int $variableSymbol): bool
	{
		return $this->variableSymbol === $variableSymbol || $this->isContainVariableSymbolInMessage($variableSymbol);
	}


	public function isContainVariableSymbolInMessage(int $variableSymbol): bool
	{
		$haystack = $this->userNotice . ' ' . $this->toMessage . ' ' . $this->message . ' ' . $this->comment;

		return strpos($haystack, (string) $variableSymbol) !== false;
	}


	public function getId(): int
	{
		return $this->id;
	}


	public function getDate(): \DateTime
	{
		return $this->date;
	}


	public function getPrice(): float
	{
		return $this->price;
	}


	public function getCurrency(): string
	{
		return $this->currency;
	}


	public function getToAccount(): ?string
	{
		return $this->toAccount;
	}


	public function getToAccountName(): ?string
	{
		return $this->toAccountName;
	}


	public function getToBankCode(): ?int
	{
		return $this->toBankCode;
	}


	public function getToBankName(): ?string
	{
		return $this->toBankName;
	}


	public function getConstantSymbol(): ?int
	{
		return $this->constantSymbol;
	}


	public function getVariableSymbol(): ?int
	{
		return $this->variableSymbol;
	}


	public function getSpecificSymbol(): ?int
	{
		return $this->specificSymbol;
	}


	public function getUserNotice(): ?string
	{
		return $this->userNotice;
	}


	public function getToMessage(): ?string
	{
		return $this->toMessage;
	}


	public function getType(): ?string
	{
		return $this->type;
	}


	public function getSender(): ?string
	{
		return $this->sender;
	}


	public function getMessage(): ?string
	{
		return $this->message;
	}


	public function getComment(): ?string
	{
		return $this->comment;
	}


	public function getBic(): ?string
	{
		return $this->bic;
	}


	public function getIdTransaction(): ?int
	{
		return $this->idTransaction;
	}
}
