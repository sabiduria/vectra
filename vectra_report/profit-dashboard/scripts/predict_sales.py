import pandas as pd
import numpy as np
from statsmodels.tsa.arima.model import ARIMA
import sys
import json
import argparse

def predict_sales(days_to_predict=30):
    # This would normally connect to your database
    # For demo purposes, we'll generate synthetic data
    dates = pd.date_range(end=pd.Timestamp.today(), periods=180, freq='D')
    sales = np.random.normal(loc=1000, scale=200, size=180).cumsum()
    
    # Create and fit ARIMA model
    model = ARIMA(sales, order=(5,1,0))
    model_fit = model.fit()
    
    # Make prediction
    forecast = model_fit.forecast(steps=days_to_predict)
    
    # Prepare output
    result = {
        "last_actual_date": dates[-1].strftime('%Y-%m-%d'),
        "last_actual_value": float(sales[-1]),
        "forecast_dates": [d.strftime('%Y-%m-%d') for d in pd.date_range(start=dates[-1], periods=days_to_predict+1, freq='D')[1:]],
        "forecast_values": [float(v) for v in forecast]
    }
    
    return result

if __name__ == "__main__":
    parser = argparse.ArgumentParser()
    parser.add_argument("--days", type=int, default=30, help="Number of days to predict")
    args = parser.parse_args()
    
    prediction = predict_sales(args.days)
    print(json.dumps(prediction))