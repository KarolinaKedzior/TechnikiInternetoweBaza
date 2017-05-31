/*
 * LabCharts version 1.1
 * http://www.code-laboratory.com/
 *
 * Copyright (c) 2009 http://code-laboratory.com
 * Dual licensed under the MIT and GPL licenses.
 *
 * 2009-12-04 19:00
 * 2010-01-30 13:25 edited to v 1.1
 */

*** Czym jest LabCharts?

LabCharts jest klasą php, która pozwala na dynamiczne generowanie wykresów.
Klasa ta bazuje na Google Charts API. Szczegółowe informacje o klasie znajdują
się na http://code-laboratory.com
Informacje o wykresach znajdują się pod http://code.google.com/apis/chart/


*************************************************************************************
*********************************** DOKUMENTACJA ************************************
*************************************************************************************


*************** abstract class LabCharts *******************

void setData (array $data)

	@opis:
		Jedyna metoda niezbędna do wygenerowanie wykresu. Określa jakie wartości
		mają być naniesione na wykres. Metoda do wszystkich typów wykresów.
	@return:
		void (metoda nic nie zwraca);
	@parametry:
		array $data - tablica wartości, które mają być wyświetlane na wykresie.
		Wartości powinny być typu int.

void setSize (string $size)

	@opis:
		Metoda definiująca wymiary wykresu. Ze względu na wymagania Google Charts API
		suma pixeli nie może przekraczać 300 tys dla jednego wykresu. Metoda do
		wszystkich typów wykresów.
	@return:
		void (metoda nic nie zwraca)
	@parametry:
		string $size - wymiary obrazka oddzielone znakiem 'x' np. 400x200

void setTitle (string $title)

	@opis:
		Metoda definiująca tytuł wykresu. Będzie on wyświetlany na górze obrazka. Metoda
		do wszystkich typów wykesów.
	@return:
		void (metoda nic nie zwraca)
	@parametry:
		string $title - tytuł wykresu np. "Średnie zyski w poszczególnych miesiącach"

void setColors (string $colors)

	@opis:
		Metoda definiująca kolory wykresów. Dla wprowadzenia większej ilości kolorów
		należy oddzielić je znakiem "|". Dla wykresu kołowego podanie pojedynczej wartości
		będzie skutkowało tym, że wykres będzie miał różne odcienie tego koloru. Dla wykresu
		słupkowego najlepiej podać tyle kolorów ile będzie słupków np. 
		"D9351C|FAAC02|79D81C|2A9DF0|02AA9D". Metoda do wszystkich typów wykresów.
	@return:
		void (metoda nic nie zwraca)
	@parametry:
		string $colors - kolor lub kolory w kodzie szesnastkowym

string getChart ()

	@opis:
		metoda zwraca ciąg znaków, który trzeba umieścić w atrybucie 'src' znacznika <img> aby
		wygenerować obrazek z wykresem. W zwracanym ciągu znaków znajdują się wszytkie parametry
		zdefiniowane wcześniej na obiekcie. Metoda do wszystkich typów wykresów.
	@return:
		string - ciąg znaków, który trzeba umieścić w atrybucie 'src' znacznika <img>
	@parametry:
		brak



*************** class LabChartsPie *******************

wartości domyślne:
typ wykresu: p
kolor wykresu: 0000FF
wymiary: 300x150


void setType (string $type)

	@opis:
		Metoda definiująca typ wykresu. Dla wykresu kołowego domyślnym typem jest "p". Innym wspieranym
		typem jest "p3", który sprawia wrażenie 3D.
	@return:
		void (metoda nic nie zwraca)
	@parametry:
		string $type - typ wykresu; możliwe wartości to "p" i "p3"

void setLabels (string $labels)

	@opis:
		Metoda definiująca nazwy etykiet kolejnych wartości wykresu zdefiniowanych w metodzie setData().
		Etykiet powinno być tyle ile wartości. Jeśli chcemy zostawić wartość niepodpisaną to poprostu
		ją opuszczamy np. "Pon|Wto||Czw"
	@return:
		void (metoda nic nie zwraca)
	@parametry:
		string $labels - podpisy etykiet poszczególnych wartości oddzielone znakiem "|"



*************** class LabChartsBar *******************

wartości domyślne:
typ wykresu: bvs
kolory słupków: D9351C|FAAC02|79D81C|2A9DF0|02AA9D
wymiary: 300x150


void setLabels (string $labels)

	@opis:
		Metoda definiująca nazwy etykiet kolejnych słupków wykresu zdefiniowanych w metodzie setData().
		Etykiet powinno być tyle ile wartości. Jeśli chcemy zostawić wartość niepodpisaną to poprostu
		ją opuszczamy np. "Pon|Wto||Czw"
	@return:
		void (metoda nic nie zwraca)
	@parametry:
		string $labels - podpisy etykiet poszczególnych wartości oddzielone znakiem "|"

void setBarStyles (int $width, [int $spaceBar])

	@opis:
		Metoda definiująca style wykresu słupkowego. Pierwszy argument metody ustawia szerokość słupków,
		a drugi odległość słupków od siebie.
	@return:
		void (metoda nic nie zwraca)
	@parametry:
		int $width - szerokość słupków
		int $spaceBar - odległość słupków od siebie

void setAxis (int $range)

	@opis:
		Metoda ustawia skale na osi y oraz co ile wartości ma być wyświetlana np. jeśli mamy wartości
		z przedziału 0-300 można ustawić wartość 30 i na osi y będą zaznaczone wartości: 0, 30, 60 itd.
	@return:
		void (metoda nic nie zwraca)
	@parametry:
		int $range - określa co ile jednostek ma być podana skala na osi y

void setGrids (int $range)

	@opis:
		Metoda definiująca położenie poziomych lini pomocniczych na wykresie. Argument $range mówi co
		ile jednostek ma być linia. Zwyke jest to ta sama wartość co w metodzie setAxis(), ale można też
		ustawić inną wartość.
	@return:
		void (metoda nic nie zwraca)
	@parametry:
		int $range - określa co ile jednostek ma być położona pozioma linia pomocnicza



*************** class LabChartsLine *******************

wartości domyślne:
typ wykresu: lc
kolor wykresu: FAAC02
wymiary: 300x150

void setAxis (int $rangeY, string $labelsX)

	@opis:
		Metoda ustawia skale na osi y oraz co ile wartości ma być wyświetlana np. jeśli mamy wartości
		z przedziału 0-300 można ustawić wartość 30 i na osi y będą zaznaczone wartości: 0, 30, 60 itd.
		Drugim argumentem są nazwy etykiet na osi x, których MUSI być tyle samo co wartości podanych
		w metodzie setData(), oddzielonych od siebie znakiem "|".
	@return:
		void (metoda nic nie zwraca)
	@parametry:
		int $rangeY - określa co ile jednostek ma być podana skala na osi y
		string $labelsX - nazwy etykiet na osi x, oddzielone od siebie znakiem "|".

void setGrids (int $rangeY)

	@opis:
		Metoda definiująca położenie poziomych i pionowych linii pomocniczych na wykresie. Argument $range mówi co
		ile jednostek ma być linia pozioma. Zwykle jest to ta sama wartość co w metodzie setAxis(), ale można też
		ustawić inną wartość. Linie pionowe są generowane automatycznie do każdej wartości na wykresie.
	@return:
		void (metoda nic nie zwraca)
	@parametry:
		int $rangeY - określa co ile jednostek ma być położona pozioma linia pomocnicza

