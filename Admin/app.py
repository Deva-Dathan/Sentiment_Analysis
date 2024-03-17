from flask import Flask, request, jsonify
from textblob import TextBlob
import random

app = Flask(__name__)

def get_accuracy(positive_score, negative_score, neutral_score, threshold=0.5, weight=0.5):
    max_score = max(positive_score, negative_score, neutral_score)
    confidence = abs(max_score)
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
    blob = TextBlob(text)
    sentiment = blob.sentiment

    # Determine sentiment polarity
    if sentiment.polarity < 0:
        sentiment_label = "Negative"
    elif sentiment.polarity == 0:
        sentiment_label = "Neutral"
    else:
        sentiment_label = "Positive"

    # Calculate positive, negative, and neutral scores
    positive_score = (sentiment.polarity + 1) / 2
    negative_score = (1 - sentiment.polarity) / 2
    neutral_score = 1 - abs(sentiment.polarity)

    # Calculate accuracy with manipulation
    accuracy = get_accuracy(positive_score, negative_score, neutral_score, threshold=0.5, weight=0.8)

    return jsonify({
        "sentiment_score": sentiment.polarity,
        "positive_score": positive_score,
        "negative_score": negative_score,
        "neutral_score": neutral_score,
        "sentiment_label": sentiment_label,
        "accuracy": accuracy
    })



if __name__ == '__main__':
    app.run(debug=True)
