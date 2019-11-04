<?php

namespace XmlBuilder;

class Builder
{

  public $currency = "EUR";
  public $currencyRate = 30;

  protected $currencyForSale = "UAH";

  public function prepareXMLStructure($data, $dom)
  {
    $today = date("Y-m-d H:i");
    //$docType = $dom->appendChild($dom->createElement('!DOCTYPE yml_catalog SYSTEM "shops.dtd"'));
    $ymlCcatalog = $dom->appendChild($dom->createElement('yml_catalog'));
    $attrDate = $dom->createAttribute('date');
    $attrDate->appendChild($dom->createTextNode($today));
    $ymlCcatalog->appendChild($attrDate);

    $shop = $dom->appendChild($dom->createElement('shop'));
    $ymlCcatalog->appendChild($shop);

    $name = $dom->appendChild($dom->createElement('name'));
    $name->appendChild($dom->createTextNode('HAKI'));
    $shop->appendChild($name);

    $company = $dom->appendChild($dom->createElement('company'));
    $company->appendChild($dom->createTextNode('HAKI'));
    $shop->appendChild($company);

    $currencies = $dom->appendChild($dom->createElement('currencies'));
    $currency = $dom->createElement('currency');
    $currencies->appendChild($currency);
    $attrId = $dom->createAttribute('id');
    $attrId->appendChild($dom->createTextNode($this->currencyForSale));

    $attrId = $dom->createAttribute('rate');
    $attrId->appendChild($dom->createTextNode(1));
    $currency->appendChild($attrId);

    $shop->appendChild($currencies);

    $categories = $dom->appendChild($dom->createElement('categories'));
    $category = $dom->createElement('category');
    $categories->appendChild($category);
    $attrId = $dom->createAttribute('id');
    $attrId->appendChild($dom->createTextNode(1));
    $category->appendChild($attrId);
    $category->appendChild($dom->createTextNode('Фаркопи'));
    $shop->appendChild($categories);

    $offers = $dom->appendChild($dom->createElement('offers'));
    $shop->appendChild($offers);
    $count = 0;
    foreach ($data as $index => $row) {
      $count++;
      if ($index > 0) {
        $priceUah = $row[12] * $this->currencyRate;
      	$data[] = array_combine($header, $row);

        $offer = $dom->appendChild($dom->createElement('offer'));
        $offers->appendChild($offer);

        $price = $dom->createElement('price');
        $offer->appendChild($price);
        $price->appendChild($dom->createTextNode($priceUah));

        $currencyId = $dom->createElement('categoryId');
        $offer->appendChild($currencyId);
        $currencyId->appendChild($dom->createTextNode($count));

        $picture = $dom->createElement('picture');
        $offer->appendChild($picture);
        $picture->appendChild($dom->createTextNode($row[14]));

        $vendor = $dom->createElement('vendor');
        $offer->appendChild($vendor);
        $vendor->appendChild($dom->createTextNode('Auto-Hak'));

        $stockQuantity = $dom->createElement('stock_quantity');
        $offer->appendChild($stockQuantity);
        $stockQuantity->appendChild($dom->createTextNode(1));

        $name = $dom->createElement('name');
        $offer->appendChild($name);
        $name->appendChild($dom->createTextNode($row[0]));

        $description = $dom->createElement('description');
        $offer->appendChild($description);
        $description->appendChild($dom->createTextNode('<![CDATA[<p>'.$row[0].'</p>]]>'));

        $paramLook = $dom->createElement('param');
        $offer->appendChild($paramLook);
        $attrName = $dom->createAttribute('name');
        $attrName->appendChild($dom->createTextNode('Вид'));
        $paramLook->appendChild($attrName);
        $paramLook->appendChild($dom->createTextNode($row[0]));

        $paramMark = $dom->createElement('param');
        $offer->appendChild($paramMark);
        $attrName = $dom->createAttribute('name');
        $attrName->appendChild($dom->createTextNode('Марка'));
        $paramMark->appendChild($attrName);
        $paramMark->appendChild($dom->createTextNode($row[1]));

        $paramModel= $dom->createElement('param');
        $offer->appendChild($paramModel);
        $attrName = $dom->createAttribute('name');
        $attrName->appendChild($dom->createTextNode('Модель'));
        $paramModel->appendChild($attrName);
        $paramModel->appendChild($dom->createTextNode($row[2]));

        $paramMod = $dom->createElement('param');
        $offer->appendChild($paramMod);
        $attrName = $dom->createAttribute('name');
        $attrName->appendChild($dom->createTextNode('Модификація'));
        $paramMod->appendChild($attrName);
        $paramMod->appendChild($dom->createTextNode($row[3]));

        $paramYear = $dom->createElement('param');
        $offer->appendChild($paramMod);
        $attrName = $dom->createAttribute('name');
        $attrName->appendChild($dom->createTextNode('Рік'));
        $paramYear->appendChild($attrName);
        $paramYear->appendChild($dom->createTextNode($row[4]));

        $paramArticle = $dom->createElement('param');
        $offer->appendChild($paramArticle);
        $attrName = $dom->createAttribute('name');
        $attrName->appendChild($dom->createTextNode('Артикул'));
        $paramArticle->appendChild($attrName);
        $paramArticle->appendChild($dom->createTextNode($row[5]));

        $paramTypeElectric = $dom->createElement('param');
        $offer->appendChild($paramTypeElectric);
        $attrName = $dom->createAttribute('name');
        $attrName->appendChild($dom->createTextNode('Тип електро-проводки'));
        $paramTypeElectric->appendChild($attrName);
        $paramTypeElectric->appendChild($dom->createTextNode($row[6]));

        $paramHorizontalWeight = $dom->createElement('param');
        $offer->appendChild($paramHorizontalWeight);
        $attrName = $dom->createAttribute('name');
        $attrName->appendChild($dom->createTextNode('Горизонтальне навантаження'));
        $paramHorizontalWeight->appendChild($attrName);
        $paramHorizontalWeight->appendChild($dom->createTextNode($row[7]));

        $paramVerticalWeight = $dom->createElement('param');
        $offer->appendChild($paramVerticalWeight);
        $attrName = $dom->createAttribute('name');
        $attrName->appendChild($dom->createTextNode('Вертикальне навантаження'));
        $paramVerticalWeight->appendChild($attrName);
        $paramVerticalWeight->appendChild($dom->createTextNode($row[8]));

        $paramWeight = $dom->createElement('param');
        $offer->appendChild($paramWeight);
        $attrName = $dom->createAttribute('name');
        $attrName->appendChild($dom->createTextNode('Вага'));
        $paramWeight->appendChild($attrName);
        $paramWeight->appendChild($dom->createTextNode($row[9]));

        $paramTakeOffBamber = $dom->createElement('param');
        $offer->appendChild($paramTakeOffBamber);
        $attrName = $dom->createAttribute('name');
        $attrName->appendChild($dom->createTextNode('Зняття бампера'));
        $paramTakeOffBamber->appendChild($attrName);
        $paramTakeOffBamber->appendChild($dom->createTextNode($row[10]));

        $paramCutBamber = $dom->createElement('param');
        $offer->appendChild($paramCutBamber);
        $attrName = $dom->createAttribute('name');
        $attrName->appendChild($dom->createTextNode('Підріз бамперу'));
        $paramCutBamber->appendChild($attrName);
        $paramCutBamber->appendChild($dom->createTextNode($row[11]));
      };

    }
    $dom->formatOutput = true;
    $farkops = $dom->saveXML();
    $dom->save('farkops.xml');
  }

  public function openFile($filePath)
  {
    $rows = array_map('str_getcsv', file($filePath));
    return $rows;
  }


  public function getHeader($rows)
  {
    $header = array_shift($rows);
    return $header;
  }
}
