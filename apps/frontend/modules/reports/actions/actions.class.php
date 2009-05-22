<?php

/**
 * reports actions.
 *
 * @package    bike
 * @subpackage reports
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class reportsActions extends sfActions
{

     protected $tempdata =  array(
 'Cat1' => array(
 'Jan 2006' => 1),
'Cat2' => array(
 'Jan 2006' => 265),
'Cat3' => array(
 'Jan 2006' => 945)
 );
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
      $userId = sfContext::getInstance()->getUser()->getAttribute('subscriber_id',null,'subscriber');
      $this->bike=null;
      $this->route=null;
      $this->report=null;
      $this->title=null;
       if ($this->getRequest()->getMethod() == sfRequest::POST)
    {
         if($userId)
         {
              $this->bike=$this->getRequestParameter('user_bike_id');
              $this->route=($this->getRequestParameter('user_ride_id'));
              $this->fromDate=($this->getRequestParameter('from_date'));
              $this->toDate=($this->getRequestParameter('to_date'));
              $this->report=($this->getRequestParameter('report'));
              $chartType=$this->getRequestParameter('chart');
              $tD=$this->getRequestParameter('threeD');
              $barChart=true;
              if($chartType && count($chartType)>0){
                  $u=$chartType[0];
                  if($u == "Line"){
                      $barChart=false;
                  }
              }
              $threeD=false;
              if($tD && $tD==1){
                  $threeD=true;
              }
              $r=$this->report;
              /*
               * Now generate the correct report
               * 0-Distance(week)
               * 1-Distance(Month)
               * 2-time(week)
               * 3-time(month)
               * 4-avg speed(week)
               * 5-avg speed(month)
               * 6-number rides(week)
               * 7-number rides(month)
               */
              if($r==0 || $r==1){
                  $this->title=$this->createDistanceGraph($barChart,$threeD,$r, $userId, $this->bike, $this->route,$this->fromDate,$this->toDate);
              }else if($r==2 || $r==3){
                  $this->title=$this->createTimeGraph($barChart,$threeD,$r, $userId, $this->bike, $this->route,$this->fromDate,$this->toDate);
              }else if($r==4 || $r==5){
                  $this->title=$this->createAvgSpeedGraph($barChart,$threeD,$r, $userId, $this->bike, $this->route,$this->fromDate,$this->toDate);
              }else if($r==6 || $r==7){
                  $this->title=$this->createNumberRidesGraph($barChart,$threeD,$r, $userId, $this->bike, $this->route,$this->fromDate,$this->toDate);
              }

         }
    }
  }

  private function createDistanceGraph($barChart,$threeD,$report,$userId,$bikeId,$rideId,$fromDate,$toDate){
      if($barChart){
          $graph = new ezcGraphBarChart();
      }else{
          $graph = new ezcGraphLineChart();
      }
      if($threeD){
        $graph->renderer = new ezcGraphRenderer3d();
      }
      $graph->title = 'Distance';
      $graphData = reportQueries::getDistanceReportData($report, $userId, $bikeId, $rideId, $fromDate, $toDate);
     
      // Add data
      foreach ( $graphData as $cat => $data )
      {
          $graph->data[$cat] = new ezcGraphArrayDataSet( $data );
      }
      $graph->data['Average']->displayType = ezcGraph::LINE;

      //display label for avg with details
      //$graph->data['Average']->highlight = true;
      //$graph->data['Average']->highlight['Mar 2006'] = false;

      $graph->options->fillLines = 210;

      $title='images/charts/DistanceGraph_'.$userId.'.svg';
      $graph->render( 650, 350, $title );
      return $title;
  }

  private function createTimeGraph($barChart,$threeD,$report,$userId,$bikeId,$rideId,$fromDate,$toDate){
      if($barChart){
          $graph = new ezcGraphBarChart();
      }else{
          $graph = new ezcGraphLineChart();
      }
    if($threeD){
        $graph->renderer = new ezcGraphRenderer3d();
      }
      $graph->title = 'Time';
      $graphData = reportQueries::getRideTimeReportData($report, $userId, $bikeId, $rideId, $fromDate, $toDate);
      // Add data
        foreach ( $graphData as $cat => $data )
      {
          $graph->data[$cat] = new ezcGraphArrayDataSet( $data );
      }
      $graph->data['Average']->displayType = ezcGraph::LINE;
      $graph->options->fillLines = 210;
      
      $title='images/charts/TimeGraph_'.$userId.'.svg';
      $graph->render( 650, 350, $title );
      return $title;
  }

  private function createAvgSpeedGraph($barChart,$threeD,$report,$userId,$bikeId,$rideId,$fromDate,$toDate){
      if($barChart){
          $graph = new ezcGraphBarChart();
      }else{
          $graph = new ezcGraphLineChart();
      }
     if($threeD){
        $graph->renderer = new ezcGraphRenderer3d();
      }
      $graph->title = 'Avg Speed';
      $graphData = reportQueries::getAvgSpeedReportData($report, $userId, $bikeId, $rideId, $fromDate, $toDate);
      // Add data
        foreach ( $graphData as $cat => $data )
      {
          $graph->data[$cat] = new ezcGraphArrayDataSet( $data );
      }
      $graph->data['Average']->displayType = ezcGraph::LINE;
      $graph->options->fillLines = 210;
      $title='images/charts/AvgSpeedGraph_'.$userId.'.svg';
      $graph->render( 650, 350, $title );
      return $title;
  }

  private function createNumberRidesGraph($barChart,$threeD,$report,$userId,$bikeId,$rideId,$fromDate,$toDate){
       if($barChart){
          $graph = new ezcGraphBarChart();
      }else{
          $graph = new ezcGraphLineChart();
      }
      if($threeD){
        $graph->renderer = new ezcGraphRenderer3d();
      }
      $graph->title = 'Number of Rides';
      $graphData = reportQueries::getRideCountReportData($report, $userId, $bikeId, $rideId, $fromDate, $toDate);
      // Add data
        foreach ( $graphData as $cat => $data )
      {
          $graph->data[$cat] = new ezcGraphArrayDataSet( $data );
      }
      $graph->data['Average']->displayType = ezcGraph::LINE;
      $graph->options->fillLines = 210;
      $title='images/charts/NumberRidesGraph_'.$userId.'.svg';
      $graph->render( 650, 350, $title );
      return $title;
  }

}
