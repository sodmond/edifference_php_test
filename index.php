<?php

interface FarmTemplate {
  public function fertilized_egg() : float ;

  public function chicken_most_eggs() : string ;

  public function chicken_most_fertilized() : string ;

  public function unfertlized_eggs_total_revenue() : float ;

  public function new_born_total() : int ;

  public function overall_egg_produced() : int;
}

/**
 * 
 */
class Farm implements FarmTemplate
{
  
  public function __construct()
  {
    $this->chickens = 50;
    $this->measured_period = 365;
    $min = 0; //min_layed_egg
    $max = 2; //max_layed_egg
    $total = 0; //total_layed_egg
    $count = 0;
    for ($i=$min; $i <= $max; $i++) { 
      $total += $i;
      $count++;
    }
    $avg_layed_egg = $total/$count;
    $this->avg_layed_egg = $avg_layed_egg;
  }

  private function avg_chicken_monthly () {
    return ($this->fertilized_egg() / 12);
  }

  /* Eggs produced by first 50 chickens */
  private function total_egg_produced() : float
  {
    $eggs = ($this->avg_layed_egg * 50) * $this->measured_period;
    return $eggs;
  }

  public function fertilized_egg() : float 
  {
    $eggs = ($this->total_egg_produced() * 50) /100;
    return $eggs;
  }

  /* This answer to this method is unknown because there is no record of the eggs produced by
   * each unique chicken. A mechanism or procedure has to be in place in order to record
   * eggs produced by each chicken on a daily basis.
  */
  public function chicken_most_eggs() : string 
  {
    return 'unknown';
  }

  /* A mechanism has to be in place to do the analysis.
   * E.g. Labelling the eggs or storing the eggs from the same chicken in same cage and label 
   * them after hashing, which will be easier to know their parents.  
   */
  public function chicken_most_fertilized() : string
  {
    return 'unknown';
  }

  public function unfertlized_eggs_total_revenue() : float
  {
    $eggs = ($this->total_egg_produced() - $this->fertilized_egg()) * 0.25;
    return ''.$eggs;
  }

  /* Because the current chickens were born in april last year and new born chickens can produce
   * after 12 months (i.e. 4months after his egg was produced and can have fertilized eggs 8months 
   * after his egg was produced), so the current chickens should start having new borns by the
   * 5th month of this year (May). New born chicken will be average chicken monthly multiplied 
   * by the remaining months (8); 
   */
  public function new_born_total() : int
  {
    //$this->avg_chicken_monthly = $this->fertilized_egg() / 12;
    $new_born = $this->avg_chicken_monthly() * 8;
    return round($new_born);
  }

  /* Because chickens produced during the year will also start laying eggs after 4 months, then 
   * only new chickens born between April and July (4 months) will be able to lay eggs before  
   * the end of the measured period.
   */
  public function overall_egg_produced() : int
  {
    $eggs_for_newborn = 0;
    for ($i=1; $i <= 4; $i++) {
      $eggs_for_newborn += (($this->avg_chicken_monthly() * $this->avg_layed_egg) * $i);
    }
    $eggs = ($this->total_egg_produced() + $eggs_for_newborn);
    return round($eggs);
  }
}

$farm = new Farm;

echo "Total Eggs Layed = " . $farm->overall_egg_produced() . "<br>";

echo "Fertilized Eggs = " . $farm->fertilized_egg() . "<br>";

echo "Chicken with most Eggs = " . $farm->chicken_most_eggs() . "<br>";

echo "Chicken with most Fertilized Eggs = " . $farm->chicken_most_fertilized() . "<br>";

echo "Unfertlized Eggs Total Revenue = " . $farm->unfertlized_eggs_total_revenue() . "<br>";

echo "Average Total New Born Chickens = " . $farm->new_born_total() . "<br>";
