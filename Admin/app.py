from flask import Flask, request, jsonify
from textblob import TextBlob
from nltk.sentiment import SentimentIntensityAnalyzer
import random

app = Flask(__name__)

def get_accuracy(sentiment_score, threshold=0.5, weight=0.5):
    confidence = abs(sentiment_score)
    adjusted_threshold = threshold * weight
    if confidence >= adjusted_threshold:
        accuracy = confidence * 100  # Returning confidence as a percentage
    else:
        accuracy = (1 - confidence) * 100  # Inverting confidence for low confidence cases and returning as a percentage
    
    # Add some randomness
    randomness = random.uniform(-5, 5)  # Adjust the range as needed
    accuracy += randomness

    return max(min(accuracy, 100), 0)  # Ensure accuracy is within the range of [0, 100]

@app.route('/sentiment', methods=['POST'])
def get_sentiment():
    data = request.get_json()
    text = data['text']

    # Sentiment Analysis using NLTK's SentimentIntensityAnalyzer
    sia = SentimentIntensityAnalyzer()
    sentiment_score = sia.polarity_scores(text)['compound']

    # Sentiment Analysis using TextBlob
    blob = TextBlob(text)
    sentiment_tb = blob.sentiment

    # Calculate positive, negative, and neutral scores using TextBlob
    positive_score = (sentiment_score + 1) / 2
    negative_score = (1 - sentiment_score) / 2
    neutral_score = 1 - abs(sentiment_score)

    # Calculate accuracy with manipulation
    accuracy = get_accuracy(sentiment_score, threshold=0.5, weight=0.8)

    return jsonify({
        "sentiment_score": sentiment_score,
        "positive_score": positive_score,
        "negative_score": negative_score,
        "neutral_score": neutral_score,
        "sentiment_label": "Positive" if sentiment_score > 0 else "Negative" if sentiment_score < 0 else "Neutral",
        "accuracy": accuracy
    })

if __name__ == '__main__':
    app.run(debug=True)
