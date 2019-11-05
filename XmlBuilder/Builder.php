<?php

namespace XmlBuilder;

class Builder
{
    /**
     * Currency in .csv file
     *
     * @var string
     */
    public $currency = "EUR";

    /**
     * Rate of currency
     *
     * @var int
     */
    public $currencyRate = 30;

    /**
     * Currency for sale in .xml file
     *
     * @var string
     */
    protected $currencyForSale = "UAH";

    /**
     * Parse .csv file and build a new xml file raw by raw
     *
     * @param $data
     * @param $dom
     */
    public function prepareXMLStructure($data, $dom)
    {
        $today = date("Y-m-d H:i");
        //$docType = $dom->appendChild($dom->createElement('!DOCTYPE yml_catalog SYSTEM "shops.dtd"'));
        $ymlCatalog = $dom->appendChild($dom->createElement('yml_catalog'));
        $attrDate = $dom->createAttribute('date');
        $attrDate->appendChild($dom->createTextNode($today));
        $ymlCatalog->appendChild($attrDate);

        $shop = $dom->appendChild($dom->createElement('shop'));
        $ymlCatalog->appendChild($shop);

        $name = $dom->appendChild($dom->createElement('name'));
        $name->appendChild($dom->createTextNode('HAKI'));
        $shop->appendChild($name);

        $company = $dom->appendChild($dom->createElement('company'));
        $company->appendChild($dom->createTextNode('HAKI'));
        $shop->appendChild($company);

        $currencies = $dom->appendChild($dom->createElement('currencies'));
        $currency = $dom->createElement('currency');
        $currencies->appendChild($currency);
        $attrCurrencyId = $dom->createAttribute('id');
        $attrCurrencyId->appendChild($dom->createTextNode($this->currencyForSale));
        $currency->appendChild($attrCurrencyId);
        $attrRateId = $dom->createAttribute('rate');
        $attrRateId->appendChild($dom->createTextNode(1));
        $currency->appendChild($attrRateId);

        $shop->appendChild($currencies);

        $categories = $dom->appendChild($dom->createElement('categories'));
        $category = $dom->createElement('category');
        $categories->appendChild($category);
        $attrCatId = $dom->createAttribute('id');
        $attrCatId->appendChild($dom->createTextNode(1));
        $category->appendChild($attrCatId);
        $category->appendChild($dom->createTextNode('Фаркопи'));
        $shop->appendChild($categories);

        $offers = $dom->appendChild($dom->createElement('offers'));
        $shop->appendChild($offers);
        $count = 0;
        foreach ($data as $index => $row) {
          $count++;
          if ($index > 0) {
            $priceUah = $row[12] * $this->currencyRate;
//            $data[] = array_combine($header, $row);

            $offer = $dom->appendChild($dom->createElement('offer'));
            $attrOfferId = $dom->createAttribute('id');
            $attrOfferId->appendChild($dom->createTextNode($count - 1));
            $offer->appendChild($attrOfferId);
            $offers->appendChild($offer);

            $price = $dom->createElement('price');
            $offer->appendChild($price);
            $price->appendChild($dom->createTextNode($priceUah));

            $currencyId = $dom->createElement('currencyId');
            $offer->appendChild($currencyId);
            $currencyId->appendChild($dom->createTextNode($this->currencyForSale));

            $categoryId = $dom->createElement('categoryId');
            $offer->appendChild($categoryId);
            $categoryId->appendChild($dom->createTextNode(1));

            $picture = $dom->createElement('picture');
            $offer->appendChild($picture);
            $picture->appendChild($dom->createTextNode($row[14]));

            $picture = $dom->createElement('picture');
            $offer->appendChild($picture);
            $picture->appendChild($dom->createTextNode($row[15]));

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
            $attrName->appendChild($dom->createTextNode($this->getHeader($data)[1]));
            $paramMark->appendChild($attrName);
            $paramMark->appendChild($dom->createTextNode($row[1]));

            $paramModel= $dom->createElement('param');
            $offer->appendChild($paramModel);
            $attrName = $dom->createAttribute('name');
            $attrName->appendChild($dom->createTextNode($this->getHeader($data)[2]));
            $paramModel->appendChild($attrName);
            $paramModel->appendChild($dom->createTextNode($row[2]));

            $paramMod = $dom->createElement('param');
            $offer->appendChild($paramMod);
            $attrName = $dom->createAttribute('name');
            $attrName->appendChild($dom->createTextNode($this->getHeader($data)[3]));
            $paramMod->appendChild($attrName);
            $paramMod->appendChild($dom->createTextNode($row[3]));

            $paramYear = $dom->createElement('param');
            $offer->appendChild($paramMod);
            $attrName = $dom->createAttribute('name');
            $attrName->appendChild($dom->createTextNode($this->getHeader($data)[4]));
            $paramYear->appendChild($attrName);
            $paramYear->appendChild($dom->createTextNode($row[4]));

            $paramArticle = $dom->createElement('param');
            $offer->appendChild($paramArticle);
            $attrName = $dom->createAttribute('name');
            $attrName->appendChild($dom->createTextNode($this->getHeader($data)[5]));
            $paramArticle->appendChild($attrName);
            $paramArticle->appendChild($dom->createTextNode($row[5]));

            $paramTypeElectric = $dom->createElement('param');
            $offer->appendChild($paramTypeElectric);
            $attrName = $dom->createAttribute('name');
            $attrName->appendChild($dom->createTextNode($this->getHeader($data)[6]));
            $paramTypeElectric->appendChild($attrName);
            $paramTypeElectric->appendChild($dom->createTextNode($row[6]));

            $paramHorizontalWeight = $dom->createElement('param');
            $offer->appendChild($paramHorizontalWeight);
            $attrName = $dom->createAttribute('name');
            $attrName->appendChild($dom->createTextNode($this->getHeader($data)[7]));
            $paramHorizontalWeight->appendChild($attrName);
            $paramHorizontalWeight->appendChild($dom->createTextNode($row[7]));

            $paramVerticalWeight = $dom->createElement('param');
            $offer->appendChild($paramVerticalWeight);
            $attrName = $dom->createAttribute('name');
            $attrName->appendChild($dom->createTextNode($this->getHeader($data)[8]));
            $paramVerticalWeight->appendChild($attrName);
            $paramVerticalWeight->appendChild($dom->createTextNode($row[8]));

            $paramWeight = $dom->createElement('param');
            $offer->appendChild($paramWeight);
            $attrName = $dom->createAttribute('name');
            $attrName->appendChild($dom->createTextNode($this->getHeader($data)[9]));
            $paramWeight->appendChild($attrName);
            $paramWeight->appendChild($dom->createTextNode($row[9]));

            $paramTakeOffBamber = $dom->createElement('param');
            $offer->appendChild($paramTakeOffBamber);
            $attrName = $dom->createAttribute('name');
            $attrName->appendChild($dom->createTextNode($this->getHeader($data)[10]));
            $paramTakeOffBamber->appendChild($attrName);
            $paramTakeOffBamber->appendChild($dom->createTextNode($row[10]));

            $paramCutBamber = $dom->createElement('param');
            $offer->appendChild($paramCutBamber);
            $attrName = $dom->createAttribute('name');
            $attrName->appendChild($dom->createTextNode($this->getHeader($data)[11]));
            $paramCutBamber->appendChild($attrName);
            $paramCutBamber->appendChild($dom->createTextNode($row[11]));
            };
        }
        $dom->formatOutput = true;
        $farkops = $dom->saveXML();
        $dom->save('farkops.xml');
    }

    /**
     * Open .csv file
     *
     * @param $filePath
     * @return array
     */
    public function openFile($filePath)
    {
        $rows = array_map('str_getcsv', file($filePath));
        return $rows;
    }

    /**
     * Get headers
     *
     * @param $rows
     * @return mixed
     */
    public function getHeader($rows)
    {
        $header = array_shift($rows);
        return $header;
    }
}
